<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $image
 * @property string $desc
 *
 */
class Store extends Model
{
    use HasSlug;
    protected $fillable = [
        'provider_id',
        'slug',
        'name',
        'email',
        'phone',
        'desc',
        'image',
        'status',
        'is_active',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getImagePathAttribute(): string
    {
        return asset('storage/' . $this->image);
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'store_id');
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

}
