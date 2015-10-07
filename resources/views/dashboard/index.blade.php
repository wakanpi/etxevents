@extends('app')

@section('title')
    ETX Events :: {{ $user->name }}
@endsection

@section('content')

    <div class="col-md-4">
       <div class="panel panel-primary">
           <div class="panel-heading"><span class="h3">Welcome {{ $user->name }}</span></div>
           <div class="panel-body">
               <ul>
                   <li><a href="/dashboard/profile">Account Settings</a></li>
                   <li><a href="/dashboard/events">My Events</a></li>
                   <li><a href="/dashboard/entities">My Entities</a></li>
               </ul>
           </div>
       </div>
    </div>

    <div class="col-md-8">
       <div class="panel panel-primary">
           <div class="panel-heading clearfix">
                <div class="col-md-6 col-sm-6">
                   <span class="h3">My Events</span>
                </div>
                <div class="col-md-6 col-sm-6 text-right">
                    <a href="/event/create" class="btn btn-success">Create Event</a>
                </div>
            </div>
           <div class="panel-body">

                @forelse($user->events as $e)
                    <p class="lead"><a href="/{{ $e->slug }}">{{ $e->title }}</a></p>
                @empty
                    <p>You have no upcomming events associated with your profile.</p>
                @endforelse

            </div>
       </div>
    </div>

@endsection

