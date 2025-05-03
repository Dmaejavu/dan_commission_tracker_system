<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    @if ($errors->any())
        <div>
            <strong>{{ $errors->first('login') }}</strong>
        </div>
    @endif
    <form action="{{ route('login') }}" method="POST">
        @csrf <!-- This is required to include the CSRF token -->
        
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>

        <button type="submit">Login</button>
    </form>
</body>
</html>