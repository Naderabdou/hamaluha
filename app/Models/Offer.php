<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Offer extends Model
{
    // use HasSlug;
    protected $fillable = [
        'provider_id',
        'desc_ar',
        'desc_en',
        'discount',
        'image',
        'type',
        'is_active',
        'start_at',
        'end_at',
    ];

    protected $appends = ['image_path'];

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

    public function getDescAttribute(): string
    {
        return $this['desc_' . app()->getLocale()];
    }

    // public function getRouteKeyName(): string
    // {
    //     return 'slug';
    // }

    public function provider():BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class,'offer_products','product_id','offer_id');
    }

}
