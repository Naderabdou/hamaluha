<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

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
        'user_id',
        'slug',
        'name',
        'email',
        'phone',
        'desc',
        'image',
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
}
