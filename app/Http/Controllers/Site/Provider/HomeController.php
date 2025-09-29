<?php

namespace App\Http\Controllers\Site\Provider;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view("provider.home");
    }
}
