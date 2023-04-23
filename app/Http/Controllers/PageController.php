<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function terms ()
    {
        return view('page.terms');
    }

    public function policy()
    {
        return view('page.policy');
    }
}
