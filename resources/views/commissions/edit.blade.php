@extends('layouts.format')

@section( 'content')
    <div class="tempContent">
        <div class="bigDIV mt-14 w-max">
            <div class="flex flex-row w-full h-full">
                <a href="{{ route('dashboardowner') }}">
                <img class="h-4/8 transistion ease-in-out duration-150 hover:scale-110 hover:cursor-pointer" src="{{ asset('images/icons8-back-64.png') }}" alt="Logo" class="back-img"
                title="Back to Commissions"> </a>
                <h1 class="w-full">Edit Commission</h1>   
            </div>
            
            <div class="medDIV">
                <form action="{{ route('commissions.update', $commission->comID) }}" method="POST">
                    @csrf
                    @method('PUT')
                <div class="medDIV-forms">
                    <label for="totalcom">Total Commission:</label>
                    <input type="number" step="0.01" name="totalcom" id="totalcom" value="{{ $commission->totalcom }}" required>
                    <br>

                    <label for="clientname">Client Name:</label>
                    <input type="text" name="clientname" id="clientname" value="{{ $commission->clientname }}" required>
                    <br>

                    <label for="status">Status:</label>
                    <select name="status" id="status" required>
                        <option value="Pending" {{ $commission->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Approved" {{ $commission->status === 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ $commission->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="Canceled" {{ $commission->status === 'Canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                    <br>
                    <div class="flex flex-col items-center justify-center">
                        <button type="submit">Update Commission</button>
                    </div>
                </form>
                </div>
            </div>
        </div> <!-- End of bigDIV -->
    </div>
@endsection