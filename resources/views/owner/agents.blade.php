@extends('layouts.format')
@section('content')
{{-- Include the sidebar --}}
@include('owner.sidebar')
<div class="content">
    <div id="ManageAgent" style="display: block;">
        <h1>Manage Agents</h1>
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
</div>
    @endsection