@extends('layouts.format')
@section('content')
{{-- Include the sidebar --}}
@include('owner.sidebar')
<div class="content">
    <div id="ManageAgent" style="display: block;">
        <h1>Manage Agents</h1>
        <div class="bigDIV">
            <div class="w-full h-max flex flex-row items-center justify-between border-b-1 border-gray-300">
                <h1>Create Agent</h1>
                <img class="w-6 transition ease-in-out duration-300 hover:cursor-pointer hover:scale-115" src="{{ asset('images/icons8-expand-arrow-100.png') }}"
                alt="expand" class="expand-img"
                onclick="showContent()"
                >
            </div>

            <div id="medDIV-content" class="medDIV-hidden">
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
            <script>
                const medDIVContent = document.getElementById('medDIV-content');

                function showContent() {
                    if (medDIVContent.style.display === 'flex') {
                        medDIVContent.style.display = 'none';
                    } else {
                        medDIVContent.style.display = 'flex';
                    }
                }
            </script>
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