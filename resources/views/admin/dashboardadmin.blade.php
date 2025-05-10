@extends('layouts.format')

@section('content')

<div class="sidebar">
    <div class="sidebar-content">
        {{-- Navigation --}}
        <nav>
            <div class="sidebar-section">
                <button onclick="showCreateCommission()">Create Commission</button>
            </div>
            <div class="sidebar-section">
                <button onclick="showViewCommissions()">View Commissions</button>
            </div>
        </nav>
        <div class="logoutDIV">
            {{-- Logout Button --}}
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</div> <!-- End of sidebar -->
    <div class="content">
        {{-- Create Commission Form --}}
        <div id="createCommission" style="display: none;">
            <div class="bigDIV">
                <h2>Create Commission</h2>
                <div class="medDIV">
                    <form action="{{ route('commissions.store') }}" method="POST">
                        @csrf
                        <div class="w-3/8">
                            <div class="medDIV-forms">
                                <label for="clientname">Client Name:</label>
                                <input type="text" name="clientname" id="clientname" required>
                                <br>
                            </div>
                            <div class="medDIV-forms">
                                <label for="totalcom">Total Commission:</label>
                                <input type="number" step="0.01" name="totalcom" id="totalcom" required>
                                <br>
                            </div>
                            <div class="medDIV-forms">
                                <label for="banktype">Bank Type:</label>
                                <select name="banktype" id="banktype" required>
                                    @foreach ($banktypes as $banktype)
                                        <option value="{{ $banktype }}">{{ $banktype }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="medDIV-forms">
                                <label for="cardtype">Card Type:</label>
                                <select name="cardtype" id="cardtype" required>
                                    @foreach ($cardtypes as $cardtype)
                                        <option value="{{ $cardtype }}">{{ $cardtype }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="medDIV-forms">
                            <label for="agentID">Agent:</label>
                                <select name="agentID" id="agentID" required>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->agentID }}">{{ $agent->agentname }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                        </div>
                        <button type="submit">Create Commission</button>
                    </form>
                    </div>
                </div>
            </div> <!-- End of bigDIV -->
        

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
    </div> <!-- End of content -->
@endsection