<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'store_id',
        'provider_id',
        'name',
        'image',
        'price',
    ];

    public function store():BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
