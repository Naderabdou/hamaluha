<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductQuestion extends Model
{
    protected $fillable = [
        'product_id',
        'question_ar',
        'question_en',
        'answer_ar',
        'answer_en',
    ];

    public function GetQuestionAttribute(): string
    {
        return $this['question_' . app()->getLocale()];
    }

    public function GetAnswerAttribute(): string
    {
        return $this['answer_' . app()->getLocale()];
    }

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


}
