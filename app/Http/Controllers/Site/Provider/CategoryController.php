<?php

namespace App\Http\Controllers\Site\Provider;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function getSubcategories($id)
{
    $subcategories = Category::where('parent_id', $id)->get();
    return response()->json($subcategories);
}

}
