<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 * @property int $user_one_id
 * @property int $user_two_id
 *
 */
class Chat extends Model
{
    protected $fillable = [
        'user_one_id',
        'user_two_id',
    ];
    public function messages():HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function userOne():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_one_id');
    }

    public function userTwo():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_two_id');
    }
}
