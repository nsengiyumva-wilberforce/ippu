@extends('layouts.app')

@section('content')
@forelse ($activityLogs as $activityLog)
<div class="card">
    <div class="card-body">
        @if($activityLog->causer)
        <b>{{ $activityLog->causer->name }}</b> <br> {{ $activityLog->description }}
        <br>
        <small>Time: {{ $activityLog->created_at->format('Y-m-d H:i:s') }}</small>
        @else
        <b>Unkown</b> <br> {{ $activityLog->description }}
        <br>
        <small>Time: {{ $activityLog->created_at->format('Y-m-d H:i:s') }}</small>
        @endif
    </div>
</div>
@empty
<div class="card">
    <div class="card-body">No activity logs found</div>
</div>
@endforelse
@endsection
