<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('homeuser.home.index');
    }
}
