<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\ETXEvent;

class DashboardController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $user = Auth::user();


        return view('dashboard.index', compact('user'));
    }
}
