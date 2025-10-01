<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasSlug;

    protected $fillable = [
        'slug',
        'category_id',
        'store_id',
        'name_ar',
        'name_en',
        'desc_ar',
        'desc_en',
        'price',
        'file',
    ];

    protected $appends = ['first_image', 'orders_number', 'file_path'];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_en')
            ->saveSlugsTo('slug');
    }

    public function getNameAttribute(): string
    {
        return $this['name_' . app()->getLocale()];
    }

    public function getDescAttribute(): string
    {
        return $this['desc_' . app()->getLocale()] ?? '';
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getFilePathAttribute()
    {
        return $this->file ? asset('storage/' . $this->file) : '';;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function offers(): BelongsToMany
    {
        return $this->belongsToMany(Offer::class, 'offer_products', 'product_id', 'offer_id');
    }


    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_items', 'product_id', 'order_id')
            ->withPivot('store_id', 'name', 'image', 'price')
            ->withTimestamps();
    }

    public function favouritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favourites', 'product_id', 'user_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }

    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating'), 1) ?? 0;
    }

    public function getFirstImageAttribute()
    {
        return $this->images()->first();
    }


    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name_ar', 'like', "%{$search}%")
                        ->orWhere('name_en', 'like', "%{$search}%");
                });
            })
            ->when($filters['categories'] ?? null, function ($query, $categories) {
                $query->whereHas('category', function ($q) use ($categories) {
                    $q->whereIn('slug', (array)$categories);
                });
            })
            ->when(($filters['min_price'] ?? null) && ($filters['max_price'] ?? null), function ($query) use ($filters) {
                $query->whereBetween('price', [$filters['min_price'], $filters['max_price']]);
            })
            ->when($filters['rating'] ?? null, function ($query, $rating) {
                $query->where('average_rating', '>=', $rating);
            });
    }

    public function scopeBestSellers($query, $limit = 10)
    {
        return $query->withCount('orders')
            ->orderByDesc('orders_count')
            ->take($limit);
    }

    public function getDiscountedPriceAttribute()
    {
        $offer = $this->offers()
            // ->where('start_at', '<=', value: now())
            ->where('end_at', '>=', now())
            ->where('type', 'discount')
            ->first();

        if ($offer) {
            $discount = ($this->price * $offer->discount) / 100;
            return $this->price - $discount;
        }

        return null;
    }


    public function getOrdersNumberAttribute()
    {
        return $this->orders()->count();
    }

    public function getTotalSalesAttribute()
    {
        return $this->orders()
            ->get()
            ->sum(function ($order) {
                return $order->pivot->price;
            });
    }

    public function questions(): HasMany
    {
        return $this->hasMany(ProductQuestion::class);
    }
}
