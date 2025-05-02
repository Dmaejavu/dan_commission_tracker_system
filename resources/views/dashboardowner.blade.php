<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
</head>
<body>
    <h1>Owner Dashboard</h1>

    {{-- Logout Button --}}
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <hr>

    {{-- Navigation --}}
    <nav>
        <button onclick="showSection('viewCommissions')">View Commissions</button>
        <button onclick="showSection('createUserOrAgent')">Create User or Agent</button>
        <button onclick="showSection('manageUserOrAgent')">Manage Users or Agents</button>
        <button onclick="showSection('viewTotalCommissions')">View Total Commissions</button>
    </nav>

    <hr>

    {{-- View Commissions --}}
    <div id="viewCommissions" style="display: none;">
        <h2>View Commissions</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Commission ID</th>
                    <th>User</th>
                    <th>Agent</th>
                    <th>Total Commission</th>
                    <th>Client Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commissions as $commission)
                    <tr>
                        <td>{{ $commission->comID }}</td>
                        <td>{{ $commission->user->username }}</td>
                        <td>{{ $commission->agent->agentname }}</td>
                        <td>{{ $commission->totalcom }}</td>
                        <td>{{ $commission->clientname }}</td>
                        <td>{{ $commission->status }}</td>
                        <td>
                            <a href="{{ route('commissions.edit', $commission->comID) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Create User or Agent --}}
    <div id="createUserOrAgent" style="display: none;">
        <h2>Create User or Agent</h2>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <h3>Create User</h3>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <label for="position">Position:</label>
            <select name="position" id="position" required>
                <option value="Admin">Admin</option>
                <option value="UnitManager">Unit Manager</option>
            </select>
            <br>
            <button type="submit">Create User</button>
        </form>

        <form action="{{ route('agents.store') }}" method="POST">
            @csrf
            <h3>Create Agent</h3>
            <label for="agentname">Agent Name:</label>
            <input type="text" name="agentname" id="agentname" required>
            <br>
            <label for="comrate">Commission Rate:</label>
            <input type="number" step="0.01" name="comrate" id="comrate" required>
            <br>
            <label for="area">Area:</label>
            <input type="text" name="area" id="area" required>
            <br>
            <button type="submit">Create Agent</button>
        </form>
    </div>

    {{-- Manage Users or Agents --}}
    <div id="manageUserOrAgent" style="display: none;">
        <h2>Manage Users or Agents</h2>
        <h3>Users</h3>
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
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->userID }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->position }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->userID) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Agents</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>Agent ID</th>
                    <th>Agent Name</th>
                    <th>Commission Rate</th>
                    <th>Area</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agents as $agent)
                    <tr>
                        <td>{{ $agent->agentID }}</td>
                        <td>{{ $agent->agentname }}</td>
                        <td>{{ $agent->comrate }}</td>
                        <td>{{ $agent->area }}</td>
                        <td>
                            <a href="{{ route('agents.edit', $agent->agentID) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- View Total Commissions --}}
    <div id="viewTotalCommissions" style="display: none;">
        <h2>View Total Commissions</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Agent Name</th>
                    <th>Total Commission</th>
                    <th>Commission Rate Taken</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agents as $agent)
                    <tr>
                        <td>{{ $agent->agentname }}</td>
                        <td>{{ $agent->commissions->sum('totalcom') }}</td>
                        <td>{{ $agent->commissions->sum('totalcom') * $agent->comrate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function showSection(sectionId) {
            const sections = ['viewCommissions', 'createUserOrAgent', 'manageUserOrAgent', 'viewTotalCommissions'];
            sections.forEach(id => {
                document.getElementById(id).style.display = id === sectionId ? 'block' : 'none';
            });
        }
    </script>
</body>
</html>