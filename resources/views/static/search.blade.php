@extends('app')

@section('title')
    Search Results :: {{ $search_phrase }}
@endsection

@section('content')

    <div class="col-md-9">

        <div class="panel panel-primary">
            <div class="panel-heading">Search Events</div>
            <div class="panel-body">
                <form id="frm_search" action="/search" method="post">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                    <input class="form-control" id="keyword" name="keywords" value="{{ $search_phrase }}" />

                    <button class="btn btn-primary">Search</button>
                </form>

            </div>
        </div>


        <h1>Search Results</h1>
        <p>Searching for {{ $search_phrase }}</p>
        @forelse ($results as $e)
            {{ $e }}
        @empty
            <p>There are no events matching the phrase {{ $search_phrase }} at this time.</p>
        @endforelse
    </div>

    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="h3">Upcoming Events</span></div>
            <div class="panel-body">

            </div>
        </div>
    </div>


@endsection