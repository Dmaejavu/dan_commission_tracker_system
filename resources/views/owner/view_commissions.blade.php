@extends('layouts.format')
@section('content')
{{-- Include the sidebar --}}
@include('owner.sidebar')

<div class="content">
    {{-- View Commissions --}}
    <div id="viewCommissions" style="display: block;">
        <div class="w-full h-max mb-5 flex flex-row items-center justify-between border-b-1 border-gray-300">
            <h1>Commissions</h1>
            <button class="w-8 h-8 flex items-center justify-center bg-gray-200 shadow-sm rounded-md transition ease-in-out duration-150 hover:shadow-md hover:scale-102 hover:bg-gray-300">
                <a href="{{ route('create_commission') }}">
                    <img class="w-auto h-5" src="{{ asset('images/icons8-plus-24.png') }}" alt="Logo" class="header-img">
                </a>
            </button>
        </div>
        {{-- Search and Filter --}}
        <div class="search-filter">
            <form action="{{ route('commissions.index') }}" method="GET">
                <input type="text" name="search" placeholder="Search by Agent Name" value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form>
        </div>
        {{--  <div class="overflow-x-hidden overflow-y-scroll max-h-[500px]"> --}}
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Agent</th>
                    <th>Total Commission</th>
                    <th>Client Name</th>
                    <th>Bank Type</th>
                    <th>Card Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commissions as $commission)
                <tr>
                    <td>{{ $commission->comID }}</td>
                    <td>{{ $commission->user->username }}</td>
                    <td>{{ $commission->agent->agentname }}</td>
                    <td>$ {{ $commission->totalcom }}</td>
                    <td>{{ $commission->clientname }}</td>
                    <td>{{ $commission->card->banktype ?? 'N/A' }}</td>
                    <td>{{ $commission->card->cardtype ?? 'N/A' }}</td>
                    <td>
                        <span 
                            class="px-2 py-1 rounded text-white text-center inline-block w-24
                            @if($commission->status == 'Approved') bg-green-300 
                            @elseif($commission->status == 'Pending') bg-orange-300 
                            @elseif($commission->status == 'Rejected') bg-red-500 
                            @elseif($commission->status == 'Canceled') bg-red-300 
                            @endif">
                            {{ $commission->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('commissions.edit', $commission->comID) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>
@endsection