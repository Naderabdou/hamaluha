<?php

namespace App\Http\Controllers\Site\General;

use App\Http\Controllers\Controller;

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
