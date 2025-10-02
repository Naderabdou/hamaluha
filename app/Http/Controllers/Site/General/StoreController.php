<?php

namespace App\Http\Controllers\Site\General;

use App\Models\Store;

use App\Models\Category;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\JoinUsRequest;
use App\Models\Product;
use App\Repositories\General\StoreRepository;

class StoreController extends Controller
{
    public function __construct(protected StoreRepository $storeRepository) {}

    public function index(Request $request)
    {
        $query = $request->get('q');

        $stores = $this->storeRepository->query()
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        return view('site.stores.index', compact('stores', 'query'));
    }

    // public function show(Request $request, $id)
    // {
    //     $store = Store::findOrFail($id);

    //     // نجيب كل الكاتيجوريز عشان الفلتر
    //     $categories = Category::all();

    //     // منتجات المتجر
    //     $products = $store->products()
    //         ->when($request->category_id, function ($q) use ($request) {
    //             $q->where('category_id', $request->category_id);
    //         })
    //         ->when($request->min_price, function ($q) use ($request) {
    //             $q->where('price', '>=', $request->min_price);
    //         })
    //         ->when($request->max_price, function ($q) use ($request) {
    //             $q->where('price', '<=', $request->max_price);
    //         })
    //         ->when($request->rating, function ($q) use ($request) {
    //             $q->whereHas('reviews', function ($query) use ($request) {
    //                 $query->havingRaw('AVG(rating) >= ?', [$request->rating]);
    //             });
    //         })
    //         ->paginate(12);

    //     return view('site.stores.show', compact('store', 'products', 'categories'));
    // }
    public function show(Request $request, $id)
    {
        $store = Store::findOrFail($id);
        $categories = Category::all();

        $favorites = [];
        if (auth()->check()) {
            $favorites = auth()->user()->favourites()->select('products.id as product_id')->pluck('product_id')->toArray();
        }
        $products = $store->products()
            ->when($request->q, function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->where('name_ar', 'like', '%' . $request->q . '%')
                        ->orWhere('name_en', 'like', '%' . $request->q . '%')
                        ->orWhere('desc_ar', 'like', '%' . $request->q . '%')
                        ->orWhere('desc_en', 'like', '%' . $request->q . '%');
                });
            })
            ->when($request->category_id, function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            })
            ->when($request->min_price, function ($q) use ($request) {
                $q->where('price', '>=', $request->min_price);
            })
            ->when($request->max_price, function ($q) use ($request) {
                $q->where('price', '<=', $request->max_price);
            })
            ->when($request->rating, function ($q) use ($request) {
                $q->whereHas('reviews', function ($query) use ($request) {
                    $query->selectRaw('avg(rating) as avg_rating, product_id')
                        ->groupBy('product_id')
                        ->having('avg_rating', '>=', $request->rating);
                });
            })
            ->paginate(12);


        return view('site.stores.show', compact('store', 'products', 'categories','favorites'));
    }



    public function joinUs(JoinUsRequest $request)
    {
        $data = $request->validated();

        $hasStore = $this->storeRepository->findBy('provider_id', auth()->id());
        if ($hasStore) {
            return back()->with('error', 'You already have a store request.');
        }

        if ($request->hasFile('image')) {
            $data['image'] = AppHelper::uploadFiles('stores', $request->file('image'));
        }

        $data['provider_id'] = auth()->id();

        $store = $this->storeRepository->create($data);

        if (!$store) {
            return back()->with('error', 'There was an issue creating your store. Please try again.');
        }

        return back()->with('success', 'Store created successfully and is pending activation.');
    }
}
