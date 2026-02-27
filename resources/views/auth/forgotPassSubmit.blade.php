@extends('layouts.loginFormat')
@section('loginInfo')
    <div class="login-imgDIV">
        <img class="w-75" src="{{ asset('images/ezd-logo.png') }}" alt="Logo" class="login-img">
    </div>
    <h1>Fogot Password</h1>
    <h3>We have sent a code to {{$email}}</h3>
    <div class="login-form">
        <form action="{{ route('resetPasswordCode') }}" method="POST">
            @csrf 
            <div class="flex flex-col mb-2">
                <label for="username">Enter Code:</label>
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="text" name="code" placeholder="******" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection