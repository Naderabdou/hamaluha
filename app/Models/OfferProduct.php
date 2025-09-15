<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferProduct extends Model
{
    protected $table = "offer_products";

    protected $fillable = [
        'offer_id',
        'product_id',
    ];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function offer():BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }
}
