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



    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function store(): HasOne
    {
        return $this->hasOne(Store::class, 'provider_id');
    }
    public function scopeHasStore($query)
    {
        return $query->whereHas('store');
    }
}
