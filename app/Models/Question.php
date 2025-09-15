<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question_ar',
        'question_en',
        'answer_ar',
        'answer_en',
    ];


    public function question(): string
    {
        return $this['question_' . app()->getLocale()];
    }

    public function answer(): string
    {
        return $this['answer_' . app()->getLocale()];
    }

}
