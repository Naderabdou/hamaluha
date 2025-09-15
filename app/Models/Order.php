<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'type',
        'name',
        'email',
        'phone',
        'status',
        'payment_status',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class,'order_items','product_id','order_id')
                    ->withPivot('provider_id','name','image','price')->withTimestamps();
    }


}
