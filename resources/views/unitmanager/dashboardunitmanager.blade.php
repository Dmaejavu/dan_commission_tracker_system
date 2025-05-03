<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit Manager Dashboard</title>
</head>
<body>
    <h1>Unit Manager Dashboard</h1>

    {{-- Logout Button --}}
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
    
    <h2>Commissions</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Commission ID</th>
                <th>User</th>
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
</body>
</html>