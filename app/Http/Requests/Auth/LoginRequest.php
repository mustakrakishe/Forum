<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest
{
    use Illuminate\Http\Request;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identifier' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ];
    }
    
    public function validate(){
        $result = ['status' => true];

        return $input = $this->all();
        $rules = $this->rules();
        
        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            $result = [
                'status' => false,
                'errors' => $validator->errors(),
            ];
        }

        if($validationResult[status]){
            $result = $request->authenticate();
        }
        return $result;
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(){
        // return $result = [
        //     'status' => false,
        //     'message' => 'Wrong data.',
        //     // 'message' => trans('auth.failed'),
        // ];
        // $result = ['status' => true];

        // $rateLimitResult = $this->ensureIsNotRateLimited();

        // if(!$rateLimitResult['status']){
        //     $result = $rateLimitResult;
        // }
        // else{
        //     $authByLogin = Auth::attempt([
        //         'login' => $this->identifier,
        //         'password' => $this->password,
        //     ], $this->boolean('remember'));
    
        //     $authByEmail = Auth::attempt([
        //         'email' => $this->identifier,
        //         'password' => $this->password,
        //     ], $this->boolean('remember'));
    
        //     $authResult = $authByLogin || $authByEmail;
    
        //     if($authResult){
        //         RateLimiter::hit($this->throttleKey());
        //     }
        //     else{
        //         RateLimiter::clear($this->throttleKey());
        //         $result = [
        //             'status' => false,
        //             'message' => 'Wrong data.',
        //             // 'message' => trans('auth.failed'),
        //         ];
        //     }
        // }

        // return $result;
    }
    
    public function ensureIsNotRateLimited(){
        // $result = [
        //     'status' => RateLimiter::tooManyAttempts($this->throttleKey(), 5)
        // ];

        // if($result['status']){
        //     event(new Lockout($this));
    
        //     $seconds = RateLimiter::availableIn($this->throttleKey());

        //     $result['message'] = 'Rate is limited.';
        //     // $result['message'] = trans('auth.throttle', [
        //     //     'seconds' => $seconds,
        //     //     'minutes' => ceil($seconds / 60),
        //     // ]);
        // }

        // return $result;
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }
}
