<?php

namespace App\Http\Controllers\Site\General;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('site.user.categories.index');
    }

    public function show($slug)
    {
        return view('site.user.categories.show', compact('slug'));
    }
}
