<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>

    <form action="{{ route('users.update', $user->userID) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="{{ $user->username }}" required>
        <br>

        <label for="password">Password (leave blank to keep current password):</label>
        <input type="password" name="password" id="password">
        <br>

        <label for="position">Position:</label>
        <select name="position" id="position" required>
            <option value="Admin" {{ $user->position === 'Admin' ? 'selected' : '' }}>Admin</option>
            <option value="UnitManager" {{ $user->position === 'UnitManager' ? 'selected' : '' }}>Unit Manager</option>
        </select>
        <br>

        <button type="submit">Update User</button>
    </form>
</body>
</html>