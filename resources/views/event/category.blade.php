@extends('app')

@section('title')
    East Texas Events :: {{ $cat->name }}
@endsection

@section('content')

    <div class="col-md-9">
        <h1>{{ $cat->name }}</h1>
        @forelse ($etx_events as $e)
            <p>
                <a href="/detail/{{ $e->slug }}"><span class="lead">{{ $e->title }}</span></a><br />
                {{ $e->description }}

            </p>
        @empty
            <p>There are currently no events listed in this category.</p>
        @endforelse
    </div>

    <div class="col-md-3">

        <div class="row clearfix">
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <a class="btn btn-success" href="/event/create"><span class="h3">Create Event</span></a>
            </div>
            <p>&nbsp;</p>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading"><span class="h3">Filter Results</span></div>
            <div class="panel-body">
                <p>You can narrow your search by clicking on any of the tags within this category</p>

                @forelse ($cat->tags as $tag)
                    <span class="btn btn-sm btn-default">{{ $tag->name }}</span>
                @empty
                    <p>There are currently no tags in this category</p>
                @endforelse
            </div>
        </div>
    </div>


@endsection