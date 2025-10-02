<?php

namespace App\Models;

use App\Models\Provider;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $image
 * @property string $desc
 * @property string $slug
 * @property int $provider_id
 * @property bool $status
 *
 */
class Store extends Model
{
    // use HasSlug;
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

    protected $appends = ['image_path', 'orders_count', 'total_revenue'];
    // public function getSlugOptions(): SlugOptions
    // {
    //     return SlugOptions::create()
    //         ->generateSlugsFrom('name')
    //         ->saveSlugsTo('slug');
    // }

    // public function getRouteKeyName(): string
    // {
    //     return 'slug';
    // }

    public function getImagePathAttribute(): string
    {
        return asset('storage/' . $this->image);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id');
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

    public function reviews()
    {
        return $this->hasManyThrough(
            Review::class,
            Product::class,
            'store_id',
            'product_id',
            'id',
            'id'
        );
    }

    public function getRatingAttribute()
{
    return round($this->reviews()->avg('rating') ?? 0, 1);
}

}
