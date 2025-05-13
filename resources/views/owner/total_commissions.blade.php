@extends('layouts.format')
@section('content')
{{-- Include the sidebar --}}
@include('owner.sidebar')
<div class="content">
    {{-- View Total Commissions --}}
    <div id="viewTotalCommissions" style="display: block;">
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
                    <td>$ {{ $agent->approvedCommissions->sum('totalcom') }}</td>
                    <td>$ {{ $agent->approvedCommissions->sum('totalcom') * $agent->comrate }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection