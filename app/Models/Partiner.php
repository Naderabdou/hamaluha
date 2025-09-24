<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partiner extends Model
{
    protected $fillable = [
        'image',
        'name_ar',
        'name_en',
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute(): string
    {
        return asset('storage/'.$this->image);
    }

    public function getNameAttribute(): string
    {
        return $this['name_'.app()->getLocale()];
    }
}
