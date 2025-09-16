<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasSlug;
    protected $fillable = [
        'slug',
        'parent_id',
        "name_ar",
        "name_en",
        "image",
        "desc_ar",
        "desc_en",
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
