<?php

namespace App\Http\Controllers\Site\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function index()
    {
        return view('site.user.favourite');
    }
}
