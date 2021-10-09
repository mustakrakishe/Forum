@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js\handlers\pages\auth\login.js') }}"></script>
    <script src="{{ asset('js\helpers\form.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form id="login-form" method="POST" action="{{ route('login') }}" validation="{{ route('login.validate') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="identifier" class="col-md-4 col-form-label text-md-right">{{ __('Name or E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="identifier" type="text" class="form-control" name="identifier" value="{{ old('identifier') }}" required autocomplete="identifier" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button class="btn btn-primary" onclick="handleLogin()">
                                {{ __('Log in') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
