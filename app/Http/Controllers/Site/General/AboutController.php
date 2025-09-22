<?php

namespace App\Http\Controllers\Site\General;

use App\Http\Controllers\Controller;
use App\Models\Goal;

class AboutController extends Controller
{
   public function index()
{
    $goals = Goal::all();
    return view('site.user.about', compact('goals'));
}

}
