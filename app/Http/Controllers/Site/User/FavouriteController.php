<?php

namespace App\Http\Controllers\Site\User;

use App\Http\Controllers\Controller;

class FavouriteController extends Controller
{
    public function index()
    {
        return view('site.user.favourite');
    }
}
