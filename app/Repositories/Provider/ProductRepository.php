<?php

namespace App\Repositories\Provider;

use App\Models\Store;
use App\Models\Product;
use App\Helpers\AppHelper;
use App\Models\Offer;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class ProductRepository extends BaseRepository
{
    /**
     * @param Store $model
     */
    public function __construct(Store $model)
    {
        parent::__construct($model);
    }

    public function create(array $data, Store $store): Product
    {
        $filePath = null;
        if (isset($data['file'])) {
            $filePath = AppHelper::uploadFiles('products/file', $data['file']);
        }

        $product = Product::create([
            'name_ar'     => $data['name_ar'],
            'name_en'     => $data['name_en'],
            'price'       => $data['price'],
            'desc_ar'     => $data['desc_ar'],
            'desc_en'     => $data['desc_en'],
            'file'        => $filePath,
            'category_id' => $data['category'],
            'store_id'    => $store->id,
        ]);

        if (isset($data['product_images']) && is_array($data['product_images'])) {
            foreach ($data['product_images'] as $image) {
                $path = AppHelper::uploadFiles('product', $image);

                $product->images()->create([
                    'image' => $path,
                ]);
            }
        }

        if (!empty($data['hasDiscount'])) {
            $offer = Offer::create([
                'desc_ar'     => $data['name_ar'],
                'desc_en'     => $data['name_en'],
                'discount'    => $data['discount'],
                'start_at'  => $data['start_at'],
                'end_at'    => $data['end_at'],
                'store_id'    => $store->id,
            ]);

            $offer->products()->sync($product->id);
        }

        return $product;
    }

    // public function update(array $data , $productId): Product
    // {
    //     $product = Product::find($productId);

    //     $product->update($data);

    //     return $product;
    // }


    public function update(array $data, $productId): Product
    {
        $product = Product::find($productId);
        $store = $product->store;

        if (isset($data['file'])) {
            $filePath = AppHelper::uploadFiles('products/file', $data['file']);
            $product->file = $filePath;
        }

        // تحديث بيانات المنتج
        $product->update([
            'name_ar'     => $data['name_ar'],
            'name_en'     => $data['name_en'],
            'price'       => $data['price'],
            'desc_ar'     => $data['desc_ar'],
            'desc_en'     => $data['desc_en'],
        ]);

        // لو فيه صور جديدة
        if (isset($data['product_images']) && is_array($data['product_images'])) {
            foreach ($data['product_images'] as $image) {
                $path = AppHelper::uploadFiles('product', $image);

                $product->images()->create([
                    'image' => $path,
                ]);
            }
        }

        if (isset($data['deleted_images'])) {
            $product->images()->whereIn('id', $data['deleted_images'])->delete();
        }

        // التعامل مع الخصم (Offer)
        if (!empty($data['hasDiscount'])) {
            $offer = $product->offers()->first(); // Assuming product->offers() علاقة many-to-many
            if ($offer) {
                // تحديث العرض الحالي
                $offer->update([
                    'discount'  => $data['discount'],
                    'start_at'  => $data['start_at'],
                    'end_at'    => $data['end_at'],
                    'store_id'  => $store->id,
                ]);
            } else {
                // إنشاء عرض جديد
                $offer = Offer::create([
                    'discount'  => $data['discount'],
                    'start_at'  => $data['start_at'],
                    'end_at'    => $data['end_at'],
                    'store_id'  => $store->id,
                ]);
                $offer->products()->syncWithoutDetaching([$product->id]);
            }
        } else {
            // لو شال الخصم نمسح أي عروض مرتبطة
            $product->offers()->detach();
        }

        return $product->fresh(); // يرجع المنتج بعد التحديث
    }

    public function destroy(Product $product)
    {
        $product->images()->delete();

        $product->offers()->detach();

        $product->delete();
    }
}
