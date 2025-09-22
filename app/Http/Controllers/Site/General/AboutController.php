<?php

namespace App\Http\Controllers\Site\General;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        return view('site.user.about');
    }
}
