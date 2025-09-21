<?php

namespace App\Http\Controllers\Site\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        return view('site.user.products.show', compact('slug'));
    }
}
