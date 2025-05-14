@extends('layouts.format')
@section('content')
{{-- Include the sidebar --}}
@include('owner.sidebar')

<div class="content">
    <h1>Edit Agent</h1>
    <form action="{{ route('agents.update', $agent->agentID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="medDIV">
            <label for="agentname">Agent Name:</label>
            <input class="input-form" type="text" name="agentname" id="agentname" value="{{ $agent->agentname }}" required>
            <br>

            <label for="comrate">Commission Rate (%):</label>
            <input class="input-form" type="number" step="0.01" name="comrate" id="comrate" value="{{ $agent->comrate }}" min="1" max="100" required>
            <br>

            <label for="area">Area:</label>
            <select class="input-form" name="area" id="area" required>
                <option value="">--Choose Area--</option>
                <option value="Davao" {{ $agent->area == 'Davao' ? 'selected' : '' }}>Davao</option>
                <option value="Samal" {{ $agent->area == 'Samal' ? 'selected' : '' }}>Samal</option>
                <option value="Cotabato" {{ $agent->area == 'Cotabato' ? 'selected' : '' }}>Cotabato</option>
                <option value="Mati" {{ $agent->area == 'Mati' ? 'selected' : '' }}>Mati</option>
            </select>
            <br>

            <button type="submit">Update Agent</button>
        </div>
    </form>
</div>
@endsection