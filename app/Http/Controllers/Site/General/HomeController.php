<?php

namespace App\Http\Controllers\Site\General;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('site.home');
    }
}
