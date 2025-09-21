<?php

namespace App\Http\Controllers\Site\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        return view('site.user.stores.index');
    }

    public function show($id)
    {
        return view('site.user.stores.show', compact('id'));
    }
}
