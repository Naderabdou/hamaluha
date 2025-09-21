<?php

namespace App\Http\Controllers\Site\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
