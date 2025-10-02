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
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar', 'en']); // also accepts a closure
        });
        $settings = app(GeneralSettings::class);

        $ViewWithSettings = function ($view) use ($settings) {
            $view->with('settings', $settings);
        };

        view()->composer('site.*', $ViewWithSettings);
          View::composer('*', function ($view) {
            $user = Auth::user();
            $store = null;
            if ($user) {
                // حاول أولًا العلاقة (user->store) لو معرفه، وإلا جِب من الجدول
                $store = $user->store ?? Store::where('provider_id', $user->id)->first();
            }
            $view->with('store', $store);
        });
    }


}
