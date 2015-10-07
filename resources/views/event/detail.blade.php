@extends('app')

@section('title')
    {{ $etx_event->title }} :: East Texas Events
@endsection

@section('content')

    <div class="col-md-9">
        <h1>{{ $etx_event->title }}</h1>
        <p>{{ $etx_event->description }}</p>
        <p>{{ $etx_event }}</p>
    </div>

    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="h3">Upcomming Events</span></div>
            <div class="panel-body">

            </div>
        </div>
    </div>


@endsection