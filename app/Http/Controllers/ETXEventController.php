<?php

namespace App\Http\Controllers;


use App\ETXCategory;
use App\ETXLocation;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateETXEventRequest;
use App\ETXEvent;
use Illuminate\Support\Facades\DB;


class ETXEventController extends Controller
{

    public function __construct()  {
        $this->middleware('auth');
    }

    protected function getCreate()  {
        $user = Auth::user();

        $locations = ETXLocation::all();
        $ary_loc = [];
        foreach ($locations as $l) {
            if (!in_array($l->name, $ary_loc)) {
                array_push($ary_loc, $l->name);
            }
        }
//        echo '<pre>';
//        print_r($ary_loc);
//        echo '</pre>';

        $json_locations = json_encode($ary_loc);

//            $json_locations = $ary_loc;

//        echo $json_locations;

        return view('event.create', compact('user', 'json_locations'));
    }

    protected function postCreate(CreateETXEventRequest $request)  {

        $this->createEvent($request);


        return redirect()->back()->with('message', 'The new event '. $this->etx_event->title .' has been created');
    }


    protected function getManage($id)
    {
        $etx_event = ETXEvent::find($id);

       dd($etx_event);
    }


    protected function getEvent($slug)
    {
        $etx_event = ETXEvent::where('slug', $slug)->first();

        return view('event.detail', compact('etx_event'));
    }



    private function createEvent($request)
    {

        $user = Auth::user();


        //  Set some variables that we will need to complete everything.
        $ts_start = strtotime($request->date_start);
        $ts_stop = strtotime($request->date_stop);
        $event_slug = str_replace(array(' ', '\'', '"'), array('-', '', ''), strtolower($request->title));



        //  Save the Location
        $location = ETXLocation::find($request->location_id);

        if (!$location)  {
            $location = new ETXLocation([
                'name' => $request->location_title,
                'address' => $request->location_address,
                'address2' => $request->location_address2,
                'city' => $request->location_city,
                'state' => $request->location_state,
                'zip' => $request->location_zip,
                'phone' => '',
                'email' => '',
                'website' => '',
                'facebook' => '',
                'twitter' => '',
                'linked_in' => ''
            ]);

            $location->save();
        }


        //  Save the Event
        $e = new ETXEvent([
            'user_id' => $user->id,
            'location_id' => $location->id,
            'date_start' => date('Y-m-d h:i:s', $ts_start),
            'date_stop' => date('Y-m-d h:i:s', $ts_stop),
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $event_slug
        ]);

        $e->save();


        $this->etx_event = $e;

        $this->assignEventCategories($request);
        $this->assignEventTags($request);


//        dd($request->all());
    }



    private function assignEventCategories($request)
    {

        foreach ($request->all() as $key => $val)  {
            if (substr($key, 0, 4) == 'cat_') {
                $category_id = $val;

                DB::table('e_t_x_categories_e_t_x_events')
                    ->insert([
                       'event_id' => $this->etx_event->id,
                        'category_id' => $category_id
                    ]);
            }
        }
    }


    private function assignEventTags($request)
    {
        $str_tags = substr($request->tags, 0, strlen($request->tags) - 1);

        $ary_tags = explode(',', $str_tags);

        foreach ($ary_tags as $tag) {
            DB::table('e_t_x_events_e_t_x_tags')
                ->insert([
                    'event_id' => $this->etx_event->id,
                    'tag_id' => $tag
                ]);
        }

//        dd($ary_tags);

    }


}
