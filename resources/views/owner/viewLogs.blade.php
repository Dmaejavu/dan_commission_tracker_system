@extends('layouts.format')
@section('content')
{{-- Include the sidebar --}}

@include('owner.sidebar')
<div class="content">
    {{-- Dashboard --}}
    <div id="viewLogs" style="display: block;">
        <div class="bigDIV">
            <div class="medDIV">
                @foreach($logList as $log)
                    <div class="longCard">
                        {{-- <form action=""> --}}
                            <h3>{{ $log->created_at->format('Y-m-d H:i:s') }}</h3>
                            <div class="longCardContent">
                                <p><strong>{{ $log->username }}</strong> <em>({{ $log->position }})</em> {{ $log->description }} </p>
                                <div class="delButtCont">
                                    <img class="wdelButt" src="{{ asset('images/icons8-white_delete-96.png') }}" alt="wdel_logo">    
                                </div>
                            </div>
                            {{-- <input type="checkbox" name="delConfirm" value="no">
                        </form> --}}
                    </div>
                @endforeach
                {{-- <table border="1">
                    <thead>
                        <tr>
                            <th>Commision ID</th>
                            <th>Client Name</th>
                            <th>Total Commision</th>
                            <th>Status</th>
                            <th>User Name</th>
                            <th>Agent Name</th>
                            <th>Creation Date</th>
                    </thead>
                    <tbody>
                        @foreach($logList as $log)
                        <tr>
                            <td>{{ $log->comID }}</td>
                            <td>{{ $log->clientName }}</td>
                            <td>{{ $log->totalCom }}</td>
                            <td>{{ $log->status }}</td>
                            <td>{{ $log->user->name ?? 'N/A' }}</td>
                            <td>{{ $log->agent->name ?? 'N/A' }}</td>
                            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
</div>

@endsection