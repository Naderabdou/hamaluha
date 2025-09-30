<?php

namespace App\Http\Controllers\Site\Provider;

use App\Http\Controllers\Controller;
use App\Models\Provider;

class HomeController extends Controller
{
    public function index()
    {
        $provider = Provider::find(auth()->id());
        $store = $provider->store->withCount(['offers', 'products'])->first();

        $products_count = $store->products_count;
        $total_revenue = $store->total_revenue;
        $orders_count = $store->orders_count;

        $bestSellers = $store->products()->bestSellers(3)->get();

        $latestOffers = $store->offers()->latest()->where('type', 'offer')->take(3)->get();

        $latestReviews = $store->reviews()->latest()->take(2)->get();

        return view('provider.home', compact('products_count','total_revenue','orders_count', 'bestSellers', 'latestOffers', 'latestReviews'));
    }
}
