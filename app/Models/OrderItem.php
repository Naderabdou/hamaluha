<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'provider_id',
        'name',
        'image',
        'price',
    ];

    public function provider():BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
}
