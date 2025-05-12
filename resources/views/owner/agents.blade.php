@extends('layouts.format')
@section('content')
{{-- Include the sidebar --}}
@include('owner.sidebar')
<div class="content">
    <div id="ManageAgent" style="display: block;">
        <h1>Manage Agents</h1>

        {{-- Create Agent Form --}}
        <div class="bigDIV">
            <h1>Create Agent</h1>
            <div class="medDIV">
                <form action="{{ route('agents.store') }}" method="POST">
                    @csrf
                    <div class="w-3/8">
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
                        </div>
                        <div class="w-3/8">
                            <button type="submit">Create Agent</button>
                        </div>
                    </div>
                </form>
            </div>
        </div> <!-- End of bigDIV -->
        <h2>Agents</h2>
        {{-- Search and Filter --}}
        <div class="search-filter">
            <form action="{{ route('agents.index') }}" method="GET">
                <input type="text" name="search" placeholder="Search Agent Name" value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form>
        </div>

        {{-- Agents Table --}}
        
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
</div>
@endsection