<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Review extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
    ];

    protected $appends = ['created_at_human'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getCreatedAtHumanAttribute()
    {
        return Carbon::parse($this->created_at)
            ->locale(app()->getLocale())
            ->diffForHumans();
    }
}
