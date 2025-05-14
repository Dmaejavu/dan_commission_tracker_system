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

                <label for="totalcom">Total Commission:</label>
                <span id="totalcom-display">$0.00</span>
                <br>

                <label for="status">Status:</label>
                <select name="status" id="status" required>
                    <option value="Pending">Pending</option>
                    <option value="Approved">Approved</option>
                </select>
                <br>
                <div class="w-full h-max flex flex-row items-center justify-end">
                    <button type="submit">Create Commission</button>
                </div>
            </div>
        </form>
    </div> <!-- End of bigDIV -->
</div>

<script>
    const banktypeSelect = document.getElementById('banktype');
    const cardtypeSelect = document.getElementById('cardtype');
    const totalcomDisplay = document.getElementById('totalcom-display');

    function updateTotalCommission() {
        const banktype = banktypeSelect.value;
        const cardtype = cardtypeSelect.value;

        if (banktype && cardtype) {
            fetch(`/get-card-price?banktype=${banktype}&cardtype=${cardtype}`)
                .then(response => response.json())
                .then(data => {
                    totalcomDisplay.textContent = `$${data.price.toFixed(2)}`;
                })
                .catch(error => {
                    console.error('Error fetching card price:', error);
                });
        } else {
            totalcomDisplay.textContent = '$0.00';
        }
    }

    banktypeSelect.addEventListener('change', updateTotalCommission);
    cardtypeSelect.addEventListener('change', updateTotalCommission);
</script>
@endsection