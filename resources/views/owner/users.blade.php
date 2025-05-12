@extends('layouts.format')
@section('content')
{{-- Include the sidebar --}}
@include('owner.sidebar')
<div class="content">
    {{-- Manage USER --}}
    <div id="ManageUser" style="display: block;">
        {{-- Create User --}}
        <h1>Manage Users</h1>
        <div class="bigDIV">
            <h1>Create User</h1>
            <div class="medDIV">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="w-3/8">
                        <div class="medDIV-forms">
                            <label for="username">Username:</label>
                            <input class="input-form" type="text" name="username" id="username" required>
                            <br>
                            <label for="password">Password:</label>
                            <input class="input-form" type="password" name="password" id="password" required>
                            <br>
                            <label for="position">Position:</label>
                            <select class="input-form" name="position" id="position" required>
                                <option value="Admin">Admin</option>
                                <option value="UnitManager">Unit Manager</option>
                            </select>
                            <br>
                            <div class="w-3/8">
                                <button type="submit">Create User</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div> <!-- End of bigDIV -->
        {{-- User Table --}}
        <h1>Users</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users->where('position', '!=', 'Owner') as $user)
                <tr>
                    <td>{{ $user->userID }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->position }}</td>
                    <td>
                        @can('edit', $user)
                        <a href="{{ route('edit_users', $user->userID) }}">Edit</a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection