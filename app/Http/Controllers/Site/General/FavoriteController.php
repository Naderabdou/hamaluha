<?php

namespace App\Http\Controllers\Site\General;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // عرض صفحة المفضلة
    public function index()
    {
        $user = Auth::user();
        $favourites = $user->favourites()->with('favouritedBy')->paginate(12);

        return view('site.fav.index', compact('favourites'));
    }

    // اضافة / حذف من المفضلة
    public function toggle($productId)
    {
        $user = Auth::user();

        if ($user->favourites()->where('product_id', $productId)->exists()) {
            $user->favourites()->detach($productId);
            return response()->json(['status' => 'removed']);
        } else {
            $user->favourites()->attach($productId);
            return response()->json(['status' => 'added']);
        }
    }
}

