@extends('layouts.format')

@section('content')
{{-- Include the sidebar --}}
@include('owner.sidebar')

<div class="content">
    <div class="bigDIV">
        <div class="medDIV">
        <div class="w-full border-1 border-t-0 border-r-0 border-l-0 border-b-gray-200 pb-1">
            <h1>Edit User</h1>
        </div>
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
                <div class="w-3/8">
                    <button type="submit">Update User</button>
                </div>
            </div>
        </form>
        </div>
    </div> <!-- End of bigDIV -->
</div>
@endsection
