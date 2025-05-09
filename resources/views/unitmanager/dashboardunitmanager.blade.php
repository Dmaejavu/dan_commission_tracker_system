@extends('layouts.format')

@section('content')

<div class="sidebar">
    <div class="sidebar-content">
        {{-- Put nav tag here if u want to add things --}}
        <div class="logoutDIV">
            {{-- Logout Button --}}
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</div>
    
<div class="content">
    <h2>Commissions</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Admin</th>
                <th>Agent</th>
                <th>Client Name</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commissions as $commission)
                <tr>
                    <td>{{ $commission->comID }}</td>
                    <td>{{ $commission->user->username }}</td>
                    <td>{{ $commission->agent->agentname }}</td>
                    <td>{{ $commission->clientname }}</td>
                    <td>{{ $commission->status }}</td>
                    <td>{{ $commission->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection