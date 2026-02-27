@extends('layouts.loginFormat')
@section('loginInfo')
    <div class="login-imgDIV">
        <img class="w-75" src="{{ asset('images/ezd-logo.png') }}" alt="Logo" class="login-img">
    </div>
    <h1>New Password</h1>
    <h3>We have sent a code to {{$email}}</h3>
    <div class="login-form">
        <form action="{{ route('passwordReset') }}" method="POST">
            @csrf 
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="flex flex-col mb-2">
                <label for="password">New Password:</label>
                <input class="input-form" type="password" name="password" placeholder="New password" id="password" required>
            </div>

            <div class="flex flex-col mb-2">
                <label for="password_confirmation">Confirm Password:</label>
                <input class="input-form" type="password" name="password_confirmation" placeholder="Confirm password" id="password_confirmation" required>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
@endsection