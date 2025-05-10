@extends('layouts.format') {{-- u can use 'layouts/format pero using '.' is the norm daw sa php coders, take notes --}}
{{-- above me is what php coders call 'include' function --}}


@section('content')
{{-- This tells Laravel where to load the format, check the views/layouts/format.blade.php for more info --}}

<div class="sidebar">
    {{-- Navigation sidebar --}}
    <div class="sidebar-content">
        <nav>
            <div class="sidebar-section">
                <button onclick="showSection('viewDashboard')">Dashboard</button>
            </div>
            <div class="sidebar-section">
                <small>Manage Commissions</small>
                <button onclick="showSection('viewCommissions')">View Commissions</button>
                <button onclick="showSection('viewTotalCommissions')">Total Commissions</button>
            </div>
            <div class="sidebar-section">
                <small>Manage Personel</small>
                <button onclick="showSection('ManageUser')">Users</button>
                <button onclick="showSection('ManageAgent')">Agent</button>
            </div>
        </nav>
        <div class="logoutDIV">
            {{-- Logout Button --}}
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div> <!-- End of sidebar-con -->

</div> <!-- End of sidebar -->

<div class="content">
    {{-- DashBoard --}}
    <div id="viewDashboard" style="display: none;">
        <h1>DASHBOARD</h1>
        <div class="dashboard-cards">
            <div class="card">
                <h2>Total Commissions</h2>
                <p>{{ $totalCommissions }}</p>
            </div>
            <div class="card">
                <h2>Total Agents</h2>
                <p>{{ $totalAgents }}</p>
            </div>
            <div class="card">
                <h2>Top Performing Agent</h2>
                <p>{{ $topAgent ? $topAgent->agentname : 'N/A' }}</p>
            </div>
        </div>
        <h2>Pending Commissions</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Agent</th>
                    <th>Client Name</th>
                    <th>Total Commission</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentPendingCommissions as $commission)
                <tr>
                    <td>{{ $commission->comID }}</td>
                    <td>{{ $commission->agent->agentname }}</td>
                    <td>{{ $commission->clientname }}</td>
                    <td>{{ $commission->totalcom }}</td>
                    <td>{{ $commission->status }}</td>
                    <td>{{ $commission->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- View Commissions --}}
    <div id="viewCommissions" style="display: none;">
        <h1>View Commissions</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Agent</th>
                    <th>Total Commission</th>
                    <th>Client Name</th>
                    <th>Bank Type</th>
                    <th>Card Type</th>
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
                    <td>{{ $commission->card->banktype ?? 'N/A' }}</td>
                    <td>{{ $commission->card->cardtype ?? 'N/A' }}</td>
                    <td>{{ $commission->status }}</td>
                    <td>
                        <a href="{{ route('commissions.edit', $commission->comID) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Manage USER --}}
    <div id="ManageUser" style="display: none;">
        {{-- Create User --}}
        <h1>Manage Users</h1>
        <div class="bigDIV">
            <h1>Create User</h1>
            <div class="medDIV">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
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
                        <button type="submit">Create User</button>
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
                        <a href="{{ route('users.edit', $user->userID) }}">Edit</a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- Manage Agents --}}
    <div id="ManageAgent" style="display: none;">
        <h1>Manage Agents</h1>
        <div class="bigDIV">
            <h1>Create Agent</h1>
            <div class="medDIV">
                <form action="{{ route('agents.store') }}" method="POST">
                    @csrf
                    <div class="medDIV-forms">
                        <label for="agentname">Agent Name:</label>
                        <input class="input-form" type="text" name="agentname" id="agentname" required>
                        <br>
                    </div>
                    <div class="medDIV-forms">
                        <label for="comrate">Commission Rate (%):</label>
                        <input class="input-form" type="number" step="0.01" name="comrate" id="comrate" required>
                        <br>
                    </div>
                    <div class="medDIV-forms">
                        <label for="area">Area:</label>
                        <input class="input-form" type="text" name="area" id="area" required>
                        <br>
                        <button type="submit">Create Agent</button>
                    </div>
                </form>
            </div>
        </div> <!-- End of bigDIV -->
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
                    <td>{{ $agent->comrate * 100 }}%</td>
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
        <h1>View Total Commissions</h1>
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
            const sections = ['viewDashboard', 'viewCommissions', 'ManageUser', 'ManageAgent', 'viewTotalCommissions'];
            sections.forEach(id => {
                document.getElementById(id).style.display = id === sectionId ? 'block' : 'none';
            });
        }

        // DEFAULT SECTION
        document.addEventListener('DOMContentLoaded', () => {
            showSection('viewDashboard');
        });
    </script>

</div> <!-- End of content -->

@endsection