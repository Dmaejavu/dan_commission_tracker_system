@extends('layouts.format')

@section('content')
{{-- Include the sidebar --}}
@include('owner.sidebar')

<div class="content">
    <div class="bigDIV">
    <h2>Create Commission</h2>
    <form action="{{ route('owner.commissions.store') }}" method="POST">
        @csrf
        <div class="medDIV">
            <label for="agentID">Agent:</label>
            <select name="agentID" id="agentID" required>
                <option> --Choose-- </option>
                @foreach ($agents as $agent)
                <option value="{{ $agent->agentID }}">{{ $agent->agentname }}</option>
                @endforeach
            </select>
            <br>

            <label for="clientname">Client Name:</label>
            <input class="input-form" type="text" name="clientname" id="clientname" required>
            <br>

            <label for="totalcom">Total Commission:</label>
            <input class="input-form" type="number" step="0.01" name="totalcom" id="totalcom" required>
            <br>

            <label for="banktype">Bank Type:</label>
            <select name="banktype" id="banktype" required>
                <option> --Choose-- </option>
                @foreach ($banktypes as $banktype)

                <option value="{{ $banktype }}">{{ $banktype }}</option>
                @endforeach
            </select>
            <br>

            <label for="cardtype">Card Type:</label>
            <select name="cardtype" id="cardtype" required>
                <option> --Choose-- </option>
                @foreach ($cardtypes as $cardtype)
                <option value="{{ $cardtype }}">{{ $cardtype }}</option>
                @endforeach
            </select>
            <br>

            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
            </select>
            <br>
            <div class="w-full h-max flex flex-row items-center justify-end">
                <button type="submit">Create Commission</button>
            </div>
        </div>
    </form>
    </div> <!-- End of bigDIV -->
</div>
@endsection