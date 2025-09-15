<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'goal_ar',
        'goal_en',
    ];

    public function getGoalAttribute(): string
    {
        return $this['goal_' . app()->getLocale()];
    }
}
