<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'store_id',
        'product_id',
        'name',
        'image',
        'price',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getCommissionAttribute()
    {
        $commissionEnabled = $settings->enable_commission;
        $commission = 0;
        if ($commissionEnabled) {
            $percentage = $settings->commission_percentage;
            $commission = ($this->price * $percentage) / 100;
        }
        return $commission;
    }

    public function getFixedFeeAttribute()
    {
        $fixedEnabled = $settings->enable_fixed_fee;
        return $fixedEnabled ? $settings->fixed_fee : 0;
    }

    public function getAdminEarningAttribute()
    {
        return $this->commission + $this->fixed_fee;
    }

    public function getVendorEarningAttribute()
    {
        return $this->price - $this->admin_earning;
    }
}
