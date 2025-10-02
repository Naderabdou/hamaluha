<?php

namespace App\Http\Controllers\Site\General;

use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::whereNull('parent_id')->get();
        $products = Product::latest()->filter($request->only(['category', 'search', 'min_price', 'max_price', 'rating']))->paginate(12);
        if ($request->ajax()) {
            return view('site.products.partials.products', compact('products'))->render();
        }

        return view('site.products.index', compact('categories', 'products'));
    }

    public function byCategory(Request $request ,string $Slug)
    {
        $categories = Category::whereNull('parent_id')->get();
        $category = Category::with(['children.products'])->whereSlug($Slug)->first();
        $products = $category->children->flatMap->products;
        if ($request->ajax()) {
            return view('site.products.partials.products', compact('products'))->render();
        }
        return view('site.products.category', compact('categories', 'category', 'products'));
    }
    public function show($slug)
    {
        $product = Product::whereSlug($slug)->first();
        $bestSellers = Product::bestSellers(4)->get();
        return view('site.products.show', compact('product', 'bestSellers'));
    }

    public function addReview(ReviewRequest $request, Product $product)
    {
        $request->validated();

        $product->reviews()->create([
            'user_id' => auth()->id(),
            'rating'  => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'تم إضافة تعليقك بنجاح');
    }

    public function download($slug)
    {
        $product = Product::whereSlug($slug)->firstOrFail();

        $filePath = storage_path('app/public/' . $product->file);

        $fileName = $product->name . '.' . pathinfo($filePath, PATHINFO_EXTENSION);

        if (!file_exists($filePath)) {
            abort(404, 'الملف غير موجود');
        }

        return response()->download($filePath, $fileName);
    }
}
