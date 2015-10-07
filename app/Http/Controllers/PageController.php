<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ETXEvent;

class PageController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->session()->get('user');

        $etx_events = ETXEvent::future()->orderBy('date_start')->get();

        return view('static.index', compact('user', 'etx_events'));
    }



    public function about(Request $request)
    {

        $user = $request->session()->get('user');

        return view('static.about', compact('user'));

    }



}
