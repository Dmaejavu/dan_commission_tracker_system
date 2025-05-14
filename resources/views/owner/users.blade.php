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
            <div class="w-full h-max flex flex-row items-center justify-between border-b-1 border-gray-300">
                <h1>Create User</h1>
                <img class="w-6 transition ease-in-out duration-300 hover:cursor-pointer hover:scale-115" src="{{ asset('images/icons8-expand-arrow-100.png') }}" 
                alt="expand" class="expand-img" id="expandIcon"
                onclick="showContent()"
                >
            </div>
            
            <div id="medDIV-content" class="medDIV-hidden">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="w-3/8">
                        <div class="medDIV-forms">
                            <label for="username">Username:</label>
                            <input class="input-form" type="text" name="username" placeholder="Username" id="username" required>
                            <br>
                            <label for="password">Password:</label>
                            <input class="input-form" type="password" name="password" placeholder="Password" id="password" required>
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
            </div> <!-- End of medDIV -->
            <script>
                const medDIVContent = document.getElementById('medDIV-content');
                const expandIcon = document.getElementById('expandIcon');

                function showContent() {
                    if (medDIVContent.style.display === 'flex') {
                        medDIVContent.style.display = 'none';
                        expandIcon.src = "{{ asset('images/icons8-expand-arrow-100.png') }}";
                    } else {
                        medDIVContent.style.display = 'flex';
                        expandIcon.src = "{{ asset('images/icons8-right-100.png') }}";
                    }
                }
            </script>
        </div> <!-- End of bigDIV -->

        {{-- User Table --}}
        <h2>Users</h2>
        <div class="search-filter">
            <form action="{{ route('users.index') }}" method="GET">
                <input type="text" name="search" placeholder="Search Username" value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form>
        </div>
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