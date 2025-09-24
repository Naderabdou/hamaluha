<?php

namespace App\Models;

use App\Models\BaseUserType;

class Customer extends BaseUserType
{
    protected static function booted() : void
    {
        static::addGlobalScope('customer', function ($builder) {
            $builder->where('type', 'user');
        });
    }

    // public function reviews() : HasMany
    // {
    //     return $this->hasMany(Review::class, 'user_id');
    // }

    // public function orders() : HasMany
    // {
    //     return $this->hasMany(Order::class, 'user_id');
    // }

    // public function favourites():BelongsToMany
    // {
    //     return $this->belongsToMany(Product::class, 'favourites', 'user_id', 'product_id');
    // }

    // public function getTotalPurchasesAttribute()
    // {
    //     return $this->orders()->sum('total');
    // }

}
