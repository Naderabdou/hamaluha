<?php

namespace App\Http\Controllers\Site\General;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function show($slug)
    {
        return view('site.user.products.show', compact('slug'));
    }
}
