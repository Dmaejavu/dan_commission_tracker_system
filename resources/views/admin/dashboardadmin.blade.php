<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>

    {{-- Logout Button --}}
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>

    {{-- Navigation --}}
    <nav>
        <button onclick="showCreateCommission()">Create Commission</button>
        <button onclick="showViewCommissions()">View Commissions</button>
    </nav>

    <hr>

    {{-- Create Commission Form --}}
    <div id="createCommission" style="display: none;">
        <h2>Create Commission</h2>
        <form action="{{ route('commissions.store') }}" method="POST">
            @csrf

            <label for="clientname">Client Name:</label>
            <input type="text" name="clientname" id="clientname" required>
            <br>

            <label for="totalcom">Total Commission:</label>
            <input type="number" step="0.01" name="totalcom" id="totalcom" required>
            <br>

            <label for="banktype">Bank Type:</label>
            <select name="banktype" id="banktype" required>
                @foreach ($banktypes as $banktype)
                    <option value="{{ $banktype }}">{{ $banktype }}</option>
                @endforeach
            </select>
            <br>

            <label for="cardtype">Card Type:</label>
            <select name="cardtype" id="cardtype" required>
                @foreach ($cardtypes as $cardtype)
                    <option value="{{ $cardtype }}">{{ $cardtype }}</option>
                @endforeach
            </select>
            <br>

            <label for="agentID">Agent:</label>
            <select name="agentID" id="agentID" required>
                @foreach ($agents as $agent)
                    <option value="{{ $agent->agentID }}">{{ $agent->agentname }}</option>
                @endforeach
            </select>
            <br>

            <button type="submit">Create Commission</button>
        </form>
    </div>

    {{-- View Commissions Table --}}
    <div id="viewCommissions" style="display: none;">
        <h2>Existing Commissions</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Commission Number</th>
                    <th>User</th>
                    <th>Agent</th>
                    <th>Total Commission</th>
                    <th>Client Name</th>
                    <th>Bank Type</th>
                    <th>Card Type</th>
                    <th>Status</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function showCreateCommission() {
            document.getElementById('createCommission').style.display = 'block';
            document.getElementById('viewCommissions').style.display = 'none';
        }

        function showViewCommissions() {
            document.getElementById('createCommission').style.display = 'none';
            document.getElementById('viewCommissions').style.display = 'block';
        }
    </script>
</body>
</html>