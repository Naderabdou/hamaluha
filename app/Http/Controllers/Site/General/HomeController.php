<?php

namespace App\Http\Controllers\Site\General;

use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\Partiner;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;

class HomeController extends Controller
{
    public function index()
    {

        $partners = Partiner::all();
        $questions = Question::all();
        // الكاتيجوري الرئيسية
        $categories = Category::whereNull('parent_id')->get();

        // المنتجات الأكثر طلباً (مثلاً حسب عدد المبيعات)
        $mostOrdered = Product::withCount('orders')->orderByDesc('orders_count')->take(10)->get();


        $mostFavourited = Product::withCount('favouritedBy')
            ->orderByDesc('favourited_by_count')
            ->take(10)
            ->get();

        $topRated = Product::withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->take(10)
            ->get();


        return view('site.home', compact('categories', 'mostOrdered', 'mostFavourited', 'topRated', 'partners', 'questions'));
    }


    public function sendContact(ContactRequest $request)
    {

        $contact = Conact::create($request->validated());

        $title = 'يريد العميل ' . $request->name . ' التواصل معك' . ' بخصوص ' . $request->message . ' وهذا رقمه ' . $request->phone;

        sendNotifyAdmin($title, 'عرض الرساله', route('filament.admin.resources.contacts.view', $contact->id));

        return response()->json(['success' => __('تم ارسال الرسالة بنجاح وسوف يتم الرد عليك في اقرب وقت')]);
    }
}
