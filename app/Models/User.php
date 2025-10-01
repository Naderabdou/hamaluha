<?php

namespace App\Models;

use Filament\Panel;
use App\Helpers\AppHelper;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $country_code
 * @property string $phone
 * @property string $code
 * @property string $code_expire_at
 * @property string $reset_token_password
 * @property string $social_type
 * @property string $social_id
 * @property bool $is_notify
 * @property string $password
 * @property string $image
 * @property string $email_verified_at
 * @property string $type
 */
class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;


    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'code',
        'desc',
        'code_expire_at',
        'reset_token_password',
        'social_type',
        'social_id',
        'is_notify',
        'password',
        'image',
        'email_verified_at',
        'type',
    ];

    protected $appends = [
        'avatar',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];




    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAvatarAttribute(): string
    {
        $name = str_replace(' ', '%20', $this->name);
        return $this->image ? asset('storage/' . $this->image) : "https://ui-avatars.com/api/?name={$name}&rounded=true";
    }

    public function firebase_tokens(): HasMany
    {
        return $this->hasMany(FirebaseToken::class, 'user_id', 'id');
    }

    public function updateUserDevice(): void
    {
        if (request()->device_id) {
            $this->firebase_tokens()->updateOrCreate([
                'device_id' => request()->device_id,
                'token_firebase' => request()->token_firebase,
            ]);
        }
    }

    private function activationCode(): int
    {
        // return mt_rand(11111, 99999);
        return '12345';
    }

    public function sendEmailVerificationCode(): bool
    {
        $this->update([
            'code' => $this->activationCode(),
            'code_expire_at' => now()->addMinutes(10),
        ]);

        //AppHelper::sendMail($this->email, $this->code, $this->name);

        return true;
    }
    public function updateToken(): string
    {
        $token = Str::random(60);
        $this->update([
            'code' => null,
            'reset_token_password' => $token,
        ]);
        return $token;
    }



    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->type, ['employee', 'admin']);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function favourites(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'favourites', 'user_id', 'product_id');
    }

    public function getTotalPurchasesAttribute()
    {
        return $this->orders()->sum('total');
    }

    public function storeRequest()
    {
        return $this->hasOne(Store::class, 'provider_id', 'id');
    }

    public function hasStoreRequest(): bool
    {
        return $this->storeRequest()->exists();
    }

    public function scopeHasStoreRequest($query)
    {
        return $query->whereHas('storeRequest', function ($q) {
            $q->where('status', 'pending');
        });
    }

    // public function purchasedProducts()
    // {
    //     return $this->hasManyThrough(
    //         Product::class,
    //         OrderItem::class,    // الموديل الوسيط
    //         'order_id',          // FK في order_items اللي بيربط بالأوردر
    //         'id',                // PK في جدول products
    //         'id',                // PK في جدول users
    //         'product_id'         // FK في order_items اللي بيربط بالـ products
    //     )->whereHas('orders', function ($q) {
    //         $q->where('user_id', $this->id)
    //             ->where('status', 'completed')
    //             ->where('payment_status', 'paid');
    //     });
    // }

    public function purchasedProducts()
    {
        return $this->orders()
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->with('orderItems.product',)
            ->get()
            ->pluck('orderItems.*.product')
            ->flatten()
            ->unique('id')
            ->values();
    }
}
