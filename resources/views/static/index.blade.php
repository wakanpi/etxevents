@extends('app')

@section('title')
    East Texas Events :: Things to do in the East Texas Area
@endsection

@section('content')

    <div class="col-md-9">

        <div class="panel panel-primary">
            <div class="panel-heading">Search Events</div>
            <div class="panel-body">
                <form id="frm_search" action="/search" method="post">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                    <input class="form-control" id="keyword" name="keywords" value="" />

                    <button class="btn btn-primary">Search</button>
                </form>

            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading"><span class="h3">Upcoming Events</span></div>
            <div class="panel-body">
                @forelse ($etx_events as $event)
                    <?php $ts_start = strtotime($event->date_start);  ?>
                   <div class="row clearfix">
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="date_wrapper">
                                <div class="date_month">{{ date('M', $ts_start) }}</div>
                                <div class="date_day">{{ date('d', $ts_start) }}</div>
                            </div>
                        </div>
                       <div class="col-md-10 col-sm-10 col-xs-10">
                           <p>
                               <a href="/detail/{{ $event->slug }}"><span class="lead">{{ $event->title }}</span></a><br />
                               {{ $event->description }}
                           </p>
                       </div>
                   </div>
                @empty
                    <p>There are no upcomming events</p>
                @endforelse
            </div>
        </div>

    </div>



    <div class="col-md-3">

        <div class="row clearfix">
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <a class="form-control btn btn-success clearfix" href="/event/create"><span class="h3">Create Event</span></a>
            </div>
            <p>&nbsp;</p>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading"><span class="h3">Events Near You</span></div>
            <div class="panel-body">
                Put a list of upcomming events here.
            </div>
        </div>


        <div class="panel panel-primary">
            <div class="panel-heading"><span class="h3">Sponsors</span></div>
            <div class="panel-body">
                Put a list of the sponsors here.
            </div>
        </div>

    </div>


@endsection