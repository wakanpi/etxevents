<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\ETXCategory;

class ETXCategoryController extends Controller
{

    protected function getCategory($slug)
    {
        $cat = ETXCategory::where('slug', $slug)->first();

        $etx_events = $cat->events;

        return view('event.category', compact('cat', 'etx_events'));

    }
}
