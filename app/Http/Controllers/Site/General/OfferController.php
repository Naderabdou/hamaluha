<?php

namespace App\Http\Controllers\Site\General;

use App\Models\Offer;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::latest()->where('type','offer')->get();
        return view('site.offers.index', compact('offers'));
    }

    public function show($id)
    {
        $offer = Offer::find($id);
        $products = $offer->products;
        return view('site.offers.show', compact('offer','products'));
    }

}
