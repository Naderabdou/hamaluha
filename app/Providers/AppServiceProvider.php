<?php

namespace App\Providers;

use App\Settings\GeneralSettings;
use Illuminate\Support\ServiceProvider;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use App\Models\Store;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // إعدادات اللغة
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch->locales(['ar', 'en']); // يدعم لغتين
        });

        // مشاركة إعدادات الموقع مع كل الـ views
        $settings = app(GeneralSettings::class);
        View::composer('*', function ($view) use ($settings) {
            $view->with('settings', $settings);
        });

        // مشاركة المتجر المرتبط بالمستخدم مع كل الـ views
        View::composer('*', function ($view) {
            $user = Auth::user();
            $userStore = null;

            if ($user) {
                // جِيب store من العلاقة لو موجودة، أو من جدول stores
                $userStore = $user->store ?? Store::where('provider_id', $user->id)->first();
            }

            $view->with('userStore', $userStore);
        });
    }
}
