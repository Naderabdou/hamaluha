<?php

namespace App\Repositories\Provider;

use App\Models\Offer;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;

class OfferRepository extends BaseRepository
{
    public function __construct(Offer $model)
    {
        parent::__construct($model);
    }

     // ✅ دي بترجع كل العروض
    public function getAll()
    {
        return $this->model->with('products')->latest()->get();
    }

    // ✅ دي بترجع عدد محدد من العروض
    public function getLimited($limit = 4)
    {
        return $this->model->with('products')->latest()->take($limit)->get();
    }

    public function findWithProducts(int $id): ?Offer
    {
        return $this->model->with('products')->find($id);
    }

    public function createOffer(array $data): Offer
    {
        if (isset($data['image']) && $data['image']->isValid()) {
            $data['image'] = $data['image']->store('offers', 'public');
        }

        $offer = $this->model->create($data);

        if (!empty($data['products'])) {
            $offer->products()->sync($data['products']);
        }

        return $offer;
    }

    public function updateOffer(int $id, array $data): bool
    {
        $offer = $this->findWithProducts($id);
        if (!$offer) {
            return false;
        }

        if (isset($data['image']) && $data['image']->isValid()) {
            // حذف الصورة القديمة لو فيه
            if ($offer->image && Storage::disk('public')->exists($offer->image)) {
                Storage::disk('public')->delete($offer->image);
            }
            $data['image'] = $data['image']->store('offers', 'public');
        }

        $offer->update($data);

        if (!empty($data['products'])) {
            $offer->products()->sync($data['products']);
        }

        return true;
    }

    // public function deleteOffer(int $id): bool
    // {
    //     $offer = $this->findWithProducts($id);
    //     if (!$offer) {
    //         return false;
    //     }

    //     // حذف الصورة لو موجودة
    //     if ($offer->image && Storage::disk('public')->exists($offer->image)) {
    //         Storage::disk('public')->delete($offer->image);
    //     }

    //     return $offer->delete();
    // }

    public function activate(int $id): bool
    {
        $offer = $this->findWithProducts($id);
        if (!$offer) {
            return false;
        }

        $offer->start_at = now();
        $offer->end_at = $offer->end_at > now() ? $offer->end_at : now()->addDays(7);
        return $offer->save();
    }

    public function pause(int $id): bool
    {
        $offer = $this->findWithProducts($id);
        if (!$offer) {
            return false;
        }

        $offer->end_at = now();
        return $offer->save();
    }


}
