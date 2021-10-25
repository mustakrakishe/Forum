<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Which field shoud be attemped.
     *
     * @var array
     */
    protected $identifiable = [
        'name',
        'email',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Extending methods

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function login(Request $request)
    {
        $errors = $this->validateLogin($request);
        if($errors){
            return [
                'status' => 0,
                'errors' => $errors,
            ];
        }
        
        if(!$this->attemptLogin($request)){
            return [
                'status' => 0,
                'errors' => [
                    'identifier' => [trans('auth.failed')],
                    'password' => [trans('auth.failed')],
                ],
            ];
        }

        return ['status' => 1];
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function validateLogin(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'identifier' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return [];
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $result = false;

        foreach ($this->identifiable as $identifier){
            $result = $this->guard()->attempt([
                $identifier => $request->identifier,
                'password' =>  $request->password,
            ], $request->filled('remember'));

            if($result){
                break;
            }
        }

        return $result;
    }

    /**
     * Get the user identification field to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'identifier';
    }
}
