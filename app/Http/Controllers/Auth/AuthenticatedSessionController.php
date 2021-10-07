<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    public function isValid(Request $request){
        $result = ['status' => true];

        $input = $request->all();
        $rules = [
            'identifier' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ];
        
        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            $result = [
                'status' => false,
                'errors' => $validator->errors(),
            ];
        }

        if($result['status']){
            $result = $this->authenticate($request);
        }

        return $result;
    }

    public function store(LoginRequest $request){
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Request methods

    public function authenticate($request){
        $result = ['status' => true];

        $rateLimitResult = $this->ensureIsNotRateLimited($request);

        if(!$rateLimitResult['status']){
            $result = $rateLimitResult;
        }
        else{
            $authByLogin = Auth::attempt([
                'login' => $request->identifier,
                'password' => $request->password,
            ], $request->boolean('remember'));
    
            $authByEmail = Auth::attempt([
                'email' => $request->identifier,
                'password' => $request->password,
            ], $request->boolean('remember'));
    
            $authResult = $authByLogin || $authByEmail;
    
            if($authResult){
                RateLimiter::hit($this->throttleKey($request));
            }
            else{
                RateLimiter::clear($this->throttleKey($request));
                $result = [
                    'status' => false,
                    'message' => trans('auth.failed'),
                ];
            }
        }

        return $result;
    }
    
    public function ensureIsNotRateLimited($request){
        $result = ['status' => true];

        $isRateLimited = RateLimiter::tooManyAttempts($this->throttleKey($request), 5);

        if($isRateLimited){
            event(new Lockout($request));
    
            $seconds = RateLimiter::availableIn($this->throttleKey($request));

            $result = [
                'status' => false,
                'message' => trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]),
            ];
        }

        return $result;
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey($request)
    {
        return Str::lower($request->input('identifier')).'|'.$request->ip();
    }
}
