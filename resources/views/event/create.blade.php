@extends('app')

@section('title')
    Create New Event :: ETX Events
@endsection

@section('header')
    <script type="text/javascript" src="/js/datetimepicker.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css" />
@endsection

@section('content')

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-danger">
        @foreach($errors->all() as $e)
            <p>{{ $e }}</p>
        @endforeach
        </div>
    @endif

    <div class="row clearfix">
        <form id="frm_event_create" action="/event/create" method="post">
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="tags" id="tags" value="" />
            <input type="hidden" name="location_id" id="location_id" value="0" />
            <div class="col-md-7 col-sm-7">
               <div class="panel panel-primary">
                   <div class="panel-heading"><span class="h3">Create New Event</span></div>
                   <div class="panel-body">



                       <p>Please fill out the form below to create your new event.</p>

                       <div class="row">
                           <div class="col-md-6 col-sm-6">
                               <label for="date_start">Start Date/Time:</label>
                               <input type="text" class="form-control" name="date_start" id="date_start" value="{{ old('date_start') }}" />
                           </div>
                           <div class="col-md-6 col-sm-6">
                               <label for="date_stop">End Date/Time:</label>
                               <input type="text" class="form-control" name="date_stop" id="date_stop" value="{{ old('date_stop') }}" />
                           </div>
                       </div>

                        <label for="title">Event Title:</label>
                        <input class="form-control" name="title" id="title" value="{{ old('title') }}">

                        <label for="description">Event Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="4"></textarea>

                   </div>
               </div>

                <div class="panel panel-primary">
                    <div class="panel-heading"><span class="h3">Location Details:</span></div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12">
                                <label for="location_title">Location Title:</label>
                                <input type="text" class="form-control" name="location_title" id="location_title" value="{{ old('location_title') }}" />
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-9">
                                <label for="location_address">Address:</label>
                                <input type="text" class="form-control" name="location_address" id="location_address" value="{{ old('location_address') }}" />
                            </div>
                            <div class="col-md-3">
                                <label for="location_address2">Address 2:</label>
                                <input type="text" class="form-control" name="location_address2" id="location_address2" value="{{ old('location_address2')  }}" />
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-5">
                                <label for="location_city">City:</label>
                                <input type="text" class="form-control" name="location_city" id="location_city" value="{{ old('location_city') }}" />
                            </div>
                            <div class="col-md-3">
                                <label for="location_state">State:</label>
                                <input type="text" class="form-control" name="location_state" id="location_state" value="{{ old('location_state') }}" />
                            </div>
                            <div class="col-md-4">
                                <label for="location_zip">Zip:</label>
                                <input type="text" class="form-control" name="location_zip" id="location_zip" value="{{ old('location_zip') }}" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-5 col-sm-5">

                <div class="panel panel-primary">
                    <div class="panel-heading"><span class="h3">Category:</span></div>
                    <div id="cat_wrapper" class="panel-body">
                        <p>Plese select the categories that you would like your event to appear under.</p>

                        @foreach (\App\ETXCategory::all()->sortBy('name') as $cat)
                            <input class="etx_cat" type="checkbox" id="cat_{{ $cat->id }}" name="cat_{{ $cat->id }}" value="{{ $cat->id }}"> {{ $cat->name }}<br />
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading"><span class="h3">Tags:</span></div>
                    <div class="panel-body">
                        <p>
                            Please select the Tags you would like to associate with your event.  Tags are like sub-categories or
                            keywords that someone may use while searching.
                        </p>

                        <div id="tag_wrapper"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="text-right">
        <button id="btn_create_event" class="btn btn-lg btn-success" type="submit">Create Event</button>
    </div>

@endsection


@section('footer')

    <script type="text/javascript">
        $('#date_start').datetimepicker({
            format: 'm/d/Y h:i'
        });
        $('#date_stop').datetimepicker();


        $('#cat_wrapper').on('click', '.etx_cat', ApplyCategoryTags);

        $('#tag_wrapper').on('click', '.etx_tag', ToggleTagSelection);


        $('#btn_create_event').click(function() {
            $('#frm_event_create').submit();
        });


        function ApplyCategoryTags()
        {

            if ($(this).is(':checked'))  {
                var url = '/ajax/event-category-tags';
                var data = {
                    catID: $(this).val(),
                    _token: '{{ csrf_token() }}'
                };

                $.ajax({
                    url: url,
                    data: data,
                    type: 'POST',
                    beforeSend: function () {

                    },
                    success: function (responseText) {
                        var resp = JSON.parse(responseText);
                        var newHTML = '';

                        for(x=0; x<resp.cbdata.length; x++) {
                            newHTML += '<span data-cat="'+ data.catID +'" data-tag="'+ resp.cbdata[x].id +'" id="tag_'+ resp.cbdata[x].id +'" class="btn btn-default btn-sm etx_tag">'+ resp.cbdata[x].name +'</span> ';
                        }

                        $('#tag_wrapper').append(newHTML);

                        console.log(resp);
                    }
                });




            }  else  {
                var cID = $(this).val();

                $('#tag_wrapper span').each(function() {

                    if ($(this).attr('data-cat') == cID) {
                        $(this).remove();
                    }
                });
            }
        }


        var availableLocations = JSON.parse('{!! $json_locations !!}');

//        console.log(availableLocations);
        $('#location_title').autocomplete({
            source: availableLocations,
            select: function(e, ui)  {
                console.log(e);
                console.log(ui);

                autoPopulateLocation(ui.item.label);
            }
        });


        function ToggleTagSelection()
        {
            var t = $(this).attr('data-tag');

            if ($(this).hasClass('btn-default')) {
                $(this).removeClass('btn-default').addClass('btn-primary');
                addEventTag(t);
            }  else  {
                $(this).removeClass('btn-primary').addClass('btn-default');
                removeEventTag(t);
            }
        }


        function addEventTag(t)
        {
            var old = $("#tags").val();
            var newtags = old + t +",";
            $('#tags').val(newtags);
        }

        function removeEventTag(t)
        {
            var old = $('#tags').val();
            var newtags = old.replace(t+",", '');
            $('#tags').val(newtags);
        }

        function autoPopulateLocation(l)
        {
            console.log(l);
        }
    </script>

@endsection