<?php

namespace App\Http\Controllers\Site\Provider;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Repositories\Provider\OfferRepository;
use App\Http\Requests\Provider\StoreOfferRequest;
use App\Models\Offer;

class OfferController extends Controller
{
    protected OfferRepository $offers;

    public function __construct(OfferRepository $offers)
    {
        $this->offers = $offers;
    }

    public function index()
    {
        $offers = $this->offers->getLimited(4);
        return view('provider.offers.index', compact('offers'));
    }

    public function all()
    {
        $offers = $this->offers->getAll();
        return view('provider.offers.all', compact('offers'));
    }


    public function getLimited($limit = 4)
    {
        return $this->model->with('products')->latest()->take($limit)->get();
    }


    public function create()
    {
        $products = Product::all();
        return view('provider.offers.create', compact('products'));
    }

    public function store(StoreOfferRequest $request)
    {
        $data = $request->validated();
        $data['store_id'] = auth()->user()->store_id;

        $this->offers->createOffer($data);

        return redirect()->route('site.provider.offers.index')
            ->with('success', 'تم إضافة العرض بنجاح');
    }

    public function show(int $id)
    {
        $offer = $this->offers->findWithProducts($id);
        if (!$offer) abort(404);

        return view('provider.offers.show', compact('offer'));
    }

    public function edit($id)
    {
        $offer = $this->offers->findWithProducts($id);
        if (!$offer) {
            return redirect()->back()->with('error', 'العرض غير موجود');
        }

        $products = Product::all();
        return view('provider.offers.edit', compact('offer', 'products'));
    }

    public function update(StoreOfferRequest $request, int $id)
    {
        $data = $request->validated();
        $data['image'] = $request->file('image') ?? null;

        $updated = $this->offers->updateOffer($id, $data);

        if (!$updated) {
            return redirect()->back()->with('error', 'العرض غير موجود');
        }

        return redirect()->route('site.provider.offers.index')
            ->with('success', 'تم تعديل العرض بنجاح');
    }

    // public function destroy(int $id)
    // {
    //     $deleted = $this->offers->deleteOffer($id);

    //     if (!$deleted) {
    //         return redirect()->back()->with('error', 'العرض غير موجود');
    //     }

    //     return redirect()->route('site.provider.offers.index')
    //         ->with('success', 'تم حذف العرض بنجاح');
    // }

    public function activate(int $id)
    {
        if (!$this->offers->activate($id)) {
            return redirect()->back()->with('error', 'العرض غير موجود');
        }

        return redirect()->back()->with('success', 'تم تفعيل العرض');
    }

    public function pause(int $id)
    {
        if (!$this->offers->pause($id)) {
            return redirect()->back()->with('error', 'العرض غير موجود');
        }

        return redirect()->back()->with('success', 'تم إيقاف العرض');
    }

    public function discounted(Offer $offer)
    {
        $offer->load('products');
        return view('provider.offers.discounted', compact('offer'));
    }
}
