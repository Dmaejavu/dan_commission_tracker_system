@extends('layouts.format')
@section('content')
{{-- Include the sidebar --}}
@include('owner.sidebar')

<div class="content">
    <div class="bigDIV">
        <div class="medDIV">
        <div class="w-full border-1 border-t-0 border-r-0 border-l-0 border-b-gray-200 pb-1">
            <h1>Edit Agent</h1>
        </div>
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
                <div class="w-3/8">
                    <button type="submit">Update Agent</button>
                </div>
            </div>
        </form>
        </div>
    </div> <!-- End of bigDIV -->
</div>
@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        alert("{{ session('success') }}");
    });
</script>
@endif

@if (session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        alert("{{ session('error') }}");
    });
</script>
@endif
@endsection