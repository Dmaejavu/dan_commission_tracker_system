@extends('layouts.loginFormat')
@section('loginInfo')

            <div class="login-imgDIV">
                <img class="w-75" src="{{ asset('images/ezd-logo.png') }}" alt="Logo" class="login-img">
            </div>
            <h1>Login</h1>
            @if ($errors->any())
                <div class="error-message">
                    <strong>{{ $errors->first('login') }}</strong>
                </div>
            @endif
            <div class="login-form">
                <form action="{{ route('login') }}" method="POST">
                    @csrf 
                
                <div class="flex flex-col mb-2">
                    <label for="username">Username:</label>
                    <input class="input-form" type="text" name="username" placeholder="Username" id="username" required>
                </div>
            
                <div class="flex flex-col mb-1">
                    <label for="password">Password:</label>
                    <input class="input-form" type="password" name="password" placeholder="Password" id="password" required>
                </div>
                <a href="{{ route('forgotPass') }}">Forgot Password? </a>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
@endsection

