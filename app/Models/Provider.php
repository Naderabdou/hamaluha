<?php

namespace App\Models;

use App\Models\BaseUserType;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends BaseUserType
{
    protected static function booted()
    {
        static::addGlobalScope('provider', function ($builder) {
            $builder->where('type', 'provider');
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'provider_id');
    }

    public function getOrdersCountAttribute()
    {
        return $this->orderItems()
            ->distinct('order_id')
            ->count('order_id');
    }

    public function getTotalRevenueAttribute()
    {
        return $this->orderItems()->sum('price');
    }

    public function store(): HasOne
    {
        return $this->hasOne(Store::class, 'user_id');
    }
}
