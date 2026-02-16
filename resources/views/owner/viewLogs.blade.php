@extends('layouts.format')
@section('content')
{{-- Include the sidebar --}}

@include('owner.sidebar')
<div class="content">
    {{-- Dashboard --}}
    <div id="viewLogs" style="display: block;">
        @foreach($logList as $log)
            <div class="bigDIV">
                    <div class="medDIV">
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
                    </div>
            </div>
        @endforeach
    </div>
</div>

@endsection