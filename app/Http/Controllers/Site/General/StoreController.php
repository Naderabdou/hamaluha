<?php

namespace App\Http\Controllers\Site\General;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\joinUsRequest;
use App\Repositories\General\StoreRepository;

class StoreController extends Controller
{
    public function __construct(protected StoreRepository $storeRepository) {}
    public function index()
    {
        return view('site.user.stores.index');
    }

    public function show($id)
    {
        return view('site.user.stores.show', compact('id'));
    }

    public function joinUs(JoinUsRequest $request)
    {
        $data = $request->validated();

        $hasStore = $this->storeRepository->findBy('provider_id' , auth()->id());
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
