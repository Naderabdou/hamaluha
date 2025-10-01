<?php

namespace App\Repositories\Provider;

use App\Repositories\BaseRepository;
use App\Models\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileRepository extends BaseRepository
{
    public function __construct(Store $model)
    {
        parent::__construct($model);
    }

    /**
     * رجع بيانات المتجر الخاص بالمزود
     */
    public function getByProviderId(int $providerId): ?Store
    {
        return $this->model->with('reviews')->where('provider_id', $providerId)->first();
    }

    /**
     * تحديث بيانات المستخدم (name/email)
     */
    public function updateUser($user, array $data): void
    {
        $userData = array_filter([
            'name'  => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
        ]);

        if (! empty($userData)) {
            $user->update($userData);
        }
    }

    /**
     * معالجة صورة جديدة وحذف القديمة
     */
    public function handleImage($request, int $providerId): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        $existing = $this->getByProviderId($providerId);
        if ($existing && $existing->image) {
            Storage::disk('public')->delete($existing->image);
        }

        return $request->file('image')->store('stores', 'public');
    }

    /**
     * تحديث بيانات المتجر
     */
    public function updateByProvider(int $providerId, array $attributes): ?Store
    {
        $store = $this->getByProviderId($providerId);
        if (! $store) {
            return null;
        }

        $store->fill($attributes)->save();

        return $store->fresh();
    }

    /**
     * تجهيز بيانات المتجر للتحديث
     */
    public function prepareStoreAttributes(array $data, $user): array
    {
        $storeName = $data['store_name'] ?? $user->name;
        $slug = $data['slug'] ?? Str::slug($storeName);

        return [
            'name'  => $storeName,
            'slug'  => $slug,
            'email' => $data['store_email'] ?? $user->email,
            'phone' => $data['phone'] ?? null,
            'desc'  => $data['desc'] ?? null,
            
        ];
    }
}
