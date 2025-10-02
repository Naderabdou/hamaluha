<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name_ar;
    public string $site_name_en;
    public string $logo;
    public string $favicon;

    public string $hero_desc_ar;
    public string $hero_desc_en;

    public string $about_header_ar;
    public string $about_header_en;
    public string $about_desc_ar;
    public string $about_desc_en;

    public string $journey_step1_title_ar;
    public string $journey_step1_title_en;
    public string $journey_step1_desc_ar;
    public string $journey_step1_desc_en;
    public string $journey_step2_title_ar;
    public string $journey_step2_title_en;
    public string $journey_step2_desc_ar;
    public string $journey_step2_desc_en;
    public string $journey_step3_title_ar;
    public string $journey_step3_title_en;
    public string $journey_step3_desc_ar;
    public string $journey_step3_desc_en;

    public string $join_us_title_ar;
    public string $join_us_title_en;
    public string $join_us_desc_ar;
    public string $join_us_desc_en;

    public string $products_desc_ar;
    public string $products_desc_en;

    public string $cart_desc_ar;
    public string $cart_desc_en;

    public string $offers_desc_ar;
    public string $offers_desc_en;

    public string $stores_desc_ar;
    public string $stores_desc_en;

    public string $partners_desc_ar;
    public string $partners_desc_en;

    public string $questions_desc_ar;
    public string $questions_desc_en;

    public string $contacts_desc_ar;
    public string $contacts_desc_en;
    public string $contacts_banner;

    public string $subscribe_header_ar;
    public string $subscribe_header_en;

    public string $footer_desc_ar;
    public string $footer_desc_en;

    public string $footer_logo;

    public string $copy_right_ar;
    public string $copy_right_en;

    public string $vision_ar;
    public string $vision_en;

    public string $message_ar;
    public string $message_en;

    public string $phone;
    public string $email;
    public string $whatsapp;
    public string $appStore;
    public string $googlePlay;
    public string $address;

    public string $facebook;


    public string $instagram;

    public string|array $location;

    public ?string $hero_man;
    public ?string $about_img;
    public string $goals_img;
    public string $questions_img;
    public string $join_us_img1;
    public string $join_us_img2;
    public string $about_stores_counter;
    public string $about_products_counter;
    public string $about_purchases_counter;



    public string $policy_desc_ar;
    public string $policy_desc_en;

    public int|string $commission_percentage;
    public bool|string $enable_commission;
    public int|string $fixed_fee;
    public bool|string $enable_fixed_fee;


    public static function group(): string
    {
        return 'general';
    }
}
