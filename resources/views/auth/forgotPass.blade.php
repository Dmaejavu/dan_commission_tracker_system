@extends('layouts.loginFormat')
@section('loginInfo')
    <div class="login-imgDIV">
        <img class="w-75" src="{{ asset('images/ezd-logo.png') }}" alt="Logo" class="login-img">
    </div>
    <h1>Fogot Password</h1>
    <h3>We will send an email to the respective email of the username</h3>
    <div class="login-form">
        <form action="{{ route('forgotPassEmailVerify') }}" method="POST">
            @csrf 
            <div class="flex flex-col mb-2">
                <label for="username">Username:</label>
                <input class="input-form" type="text" name="username" placeholder="Username" id="username" required>
            </div>
            <button type="submit">Confirm</button>
        </form>
    </div>
@endsection