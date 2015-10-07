<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{

    public function index(Request $request)  {

        $user = $request->session()->get('user');

        return view('static.contact', compact('user'));

    }


    public function getContact(Request $request)  {
        return view ('static.contact', compact('user'));
    }

    public function postContact(Request $request)  {

    }
}
