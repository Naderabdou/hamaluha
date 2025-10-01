<?php

namespace App\Http\Controllers\Site\Provider;

use Illuminate\Http\Request;
use App\Models\ProductQuestion;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductQuestionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id'=> 'required|exists:products,id',
            'question_ar' => 'required|string',
            'question_en' => 'required|string',
            'answer_ar'   => 'required|string',
            'answer_en'   => 'required|string',
        ]);

        $product = Product::find($request->product_id);
        if (!$product) {
            return back()->withErrors(['product_id' => 'المنتج غير موجود']);
        }

        $product->questions()->create($request->only([
            'question_ar', 'question_en', 'answer_ar', 'answer_en'
        ]));

        return back()->with('success', 'تمت الإضافة بنجاح');
    }

    public function destroy($id)
    {
        ProductQuestion::findOrFail($id)->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}
