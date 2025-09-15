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
        'provider_id',
        'name_ar',
        'name_en',
        'desc_ar',
        'desc_en',
        'price',
        'file',
    ];

    protected $appends = ['image_path', 'name'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_en')
            ->saveSlugsTo('slug');
    }

    public function getImagePathAttribute(): string
    {
        return asset('storage/' . $this->image);
    }

    public function getNameAttribute(): string
    {
        return $this['name_' . app()->getLocale()];
    }

    public function getDescAttribute(): string
    {
        return $this['desc_' . app()->getLocale()];
    }

    public function getRouteKeyName():string
    {
        return 'slug';
    }


    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function provider():BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function offers():BelongsToMany
    {
        return $this->belongsToMany(Offer::class,'offer_products','offer_id','product_id');
    }

    public function orders():BelongsToMany
    {
        return $this->belongsToMany(Order::class,'order_items','order_id','product_id')
                    ->withPivot('provider_id','name','image','price')->withTimestamps();
    }

    public function favouritedBy():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favourites', 'product_id', 'user_id');
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function ratingAvg()
    {
        return $this->reviews()->avg('rating');
    }
}
