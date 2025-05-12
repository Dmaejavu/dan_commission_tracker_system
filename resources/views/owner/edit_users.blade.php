@extends('layouts.format')

@section('content')
{{-- Include the sidebar --}}
@include('owner.sidebar')

<div class="content">
    <h1>Edit User</h1>

    <form action="{{ route('users.update', $user->userID) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="medDIV">
            <label for="username">Username:</label>
            <input class="input-form" type="text" name="username" id="username" value="{{ $user->username }}" required>
            <br>

            <label for="password">Password (leave blank to keep current password):</label>
            <input class="input-form" type="password" name="password" id="password">
            <br>

            <label for="position">Position:</label>
            <select class="input-form" name="position" id="position" required>
                <option value="Admin" {{ $user->position === 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="UnitManager" {{ $user->position === 'UnitManager' ? 'selected' : '' }}>Unit Manager</option>
            </select>
            <br>

            <button type="submit">Update User</button>
        </div>
    </form>
</div>
@endsection
