<?php

namespace App\Http\Controllers\Site\Provider;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Provider\ProductRepository;
use App\Http\Requests\Provider\CreateProductRequest;
use App\Http\Requests\Provider\UpdateProductRequest;
use App\Models\Provider;

class ProductController extends Controller
{
    public function __construct(protected ProductRepository $productRepository) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view("provider.products.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view("provider.products.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $store = Provider::find(auth()->id())->store;
        $this->productRepository->create($request->all(), $store);

        return redirect()->route('site.provider.products.index')
            ->with('success', 'تم إضافة المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view("provider.products.show", compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view("provider.products.edit", compact("product","categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productRepository->update($request->all(), $product->id);

        return redirect()->route('site.provider.products.index')
            ->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->productRepository->destroy($product);

        return redirect()->route('site.provider.products.index')
            ->with('success', 'تم حذف المنتج بنجاح');
    }


    public function storeQuestion(Request $request) {}
}
