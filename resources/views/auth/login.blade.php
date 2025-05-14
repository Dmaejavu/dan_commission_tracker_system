<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
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
                    <input class="input-form" type="text" name="username" placeholder="e.g. angelo@gmail.com" id="username" required>
                </div>
            
                <div class="flex flex-col mb-1">
                    <label for="password">Password:</label>
                    <input class="input-form" type="password" name="password" placeholder="Password" id="password" required>
                </div>

                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>