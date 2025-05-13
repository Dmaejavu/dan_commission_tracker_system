@extends('layouts.format')
@section('content')
{{-- Include the sidebar --}}

@include('owner.sidebar')
<div class="content">
    {{-- Dashboard --}}
    <div id="viewDashboard" style="display: block;">
        <h1>Dashboard</h1>
        <div class="bigDIV">
            <div class="dashboard-cards">
                <div class="card">
                    <h2>Commissions</h2>
                    <p> $ {{ $totalCommissions }}</p>
                </div>
                <div class="card">
                    <h2>Total Agents</h2>
                    <p>{{ $totalAgents }}</p>
                </div>
                <div class="card">
                    <h2>Top Agent</h2>
                    <p>{{ $topAgent ? $topAgent->agentname : 'N/A' }}</p>
                </div>
            </div>

            <div class="medDIV">
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
                            <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($recentPendingCommissions as $commission)
                        <tr>
                            <td>{{ $commission->comID }}</td>
                            <td>{{ $commission->agent->agentname }}</td>
                            <td>{{ $commission->clientname }}</td>
                            <td>$ {{ $commission->totalcom }}</td>
                            <td>{{ $commission->status }}</td>
                            <td>{{ $commission->created_at }}</td>
                            <td>
                                <a href="{{ route('commissions.edit', $commission->comID) }}">Edit</a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection