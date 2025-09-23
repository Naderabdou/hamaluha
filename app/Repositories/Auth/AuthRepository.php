<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class AuthRepository extends BaseRepository
{
    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $identifier
     * @param string $password
     * @return User|null
     */
    public function login(array $data): ?User
    {
        $user = $this->query()
            ->where('email', $data['email'])
            ->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null;
        }

        return $user;
    }


    public function register(array $data): User
    {
        $user = parent::store($data);
        return $user;
    }

    public function forgetPassword(array $data): ?User
    {
        $user = $this->query()
            ->where('email', $data['email'])
            ->first();
        if (!$user) {
            return null;
        }
        $user->sendEmailVerificationCode();
        return $user;
    }


    public function resendCode(string $email): ?User
    {
        $user = $this->query()
            ->where('email', $email)
            ->first();
        if (!$user) {
            return null;
        }
        $user->sendEmailVerificationCode();
        return $user;
    }

    public function checkCode(array $data): ?User
    {
        $user = $this->query()
            ->where('email', session('reset_email'))
            ->where('code', $data['code'])
            ->where('code_expire_at', '>', now())
            ->first();
        if (!$user) {
            return null;
        }

        $user->token = $user->updateToken();

        return $user;
    }

    public function resetPassword(array $data): ?User
    {
        $user = $this->query()
            ->where('email', session('reset_email'))
            ->where('reset_token_password', session('reset_token'))
            ->first();

        if (!$user) {
            return null;
        }
        parent::update([
            'password' => $data['password'],
            'reset_token_password' => null,
        ], $user->id);

        return $user;
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken(); 
    }


    public function handleSocialLogin(array $data)
    {

        $validProviders = ['facebook', 'google', 'apple'];
        if (!in_array($data['provider'], $validProviders)) {
            return $this->ApiResponse([], __('Invalid provider'), 422);
        }

        $user = $this->query()->where('social_type', $data['provider'])->where('email', $data['email'])->where('type', $data['type'])->first();
        if ($user) {
            $token = $user->createToken('user-token')->plainTextToken;
            $user->token = $token;
            $user->updateUserDevice();

            return $user;
        }
        $user = parent::store([
            'name' => $data['name'],
            'email' => $data['email'],
            'social_id' => $data['social_id'],
            'social_type' => $data['provider'],
            'type' => $data['type'],
            'password' => Str::random(8), // Generate a random password
        ]);
        $user->updateUserDevice();
        $token = $user->createToken('user-token')->plainTextToken;
        $user->token = $token;
        return $user;
    }
}
