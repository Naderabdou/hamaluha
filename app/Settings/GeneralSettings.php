<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name_ar;
    public string $site_name_en;
    public string $logo = 'settings/logo.png';

    public string $favicon = 'settings/logo.png';




    public string $phone;
    public string $email;
    public string $whatsapp;
    public string $appStore;
    public string $googlePlay;
    public string $address;
    public string|array $location;


    public string $about_desc_ar;
    public string $about_desc_en;



    public string $policy_desc_ar;
    public string $policy_desc_en;


    public static function group(): string
    {
        return 'general';
    }
}
