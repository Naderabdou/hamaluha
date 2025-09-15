<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name_ar', 'حملها');
        $this->migrator->add('general.site_name_en', 'Hamellha');

        $this->migrator->add('general.logo', 'This is my website');

        $this->migrator->add('general.favicon', 'This is my website');

        $this->migrator->add('general.hero_desc_ar', 'موقع الكترونى احترافى متعدد البائعين يتيح للبائعين عرض منتجاتهم وبيعها مباشرةً للمستخدمين');
        $this->migrator->add('general.hero_desc_en', 'A professional online marketplace that allows multiple sellers to display and sell their products directly to users.');

        $this->migrator->add('general.about_header_ar', 'حول شغفك إلى دخل');
        $this->migrator->add('general.about_header_en', 'Turn your passion into income');
        $this->migrator->add('general.about_desc_ar', 'منصة مبتكرة لبيع وشراء المنتجات الرقمية، تربط بين البائعين المبدعين والمشترين الباحثين عن محتوى ممي نوفر لك بيئة آمنة وسهلة الاستخدام، سواء كنت بائعًا تسعى لنشر إبداعك أو مشتريًا تبحث عن أدوات تسهّل عملك وتطورك.');
        $this->migrator->add('general.about_desc_en', 'An innovative platform for buying and selling digital products, connecting creative sellers with buyers looking for high-quality content. We provide a safe and user-friendly environment, whether you are a seller looking to share your creativity or a buyer seeking tools to enhance your work and development.');

        $this->migrator->add('general.journey_step1_title_ar', 'سجل حساب بائع');
        $this->migrator->add('general.journey_step1_desc_ar', 'افتح حساب مجاني وقم بملفك الشخصي وتقدر تتابع منتجاتك الرقمية بكل سهولة');
        $this->migrator->add('general.journey_step1_title_en', 'Create a Seller Account');
        $this->migrator->add('general.journey_step1_desc_en', 'Open a free account, complete your profile, and easily manage your digital products');

        $this->migrator->add('general.journey_step2_title_ar', 'ارفع منتجاتك الرقمية');
        $this->migrator->add('general.journey_step2_desc_ar', 'حمل ملفاتك (كتب، قوالب، دورات، وسائل علاجية...) وحدد السعر المناسب لك');
        $this->migrator->add('general.journey_step2_title_en', 'Upload Your Digital Products');
        $this->migrator->add('general.journey_step2_desc_en', 'Upload your files (books, templates, courses, therapy tools...) and set the right price');

        $this->migrator->add('general.journey_step3_title_ar', 'استقبل المبيعات');
        $this->migrator->add('general.journey_step3_desc_ar', 'كل عملية شراء توصلك بإشعار فوري مع متابعة أرباحك بسهولة من لوحة التحكم');
        $this->migrator->add('general.journey_step3_title_en', 'Receive Sales');
        $this->migrator->add('general.journey_step3_desc_en', 'Every purchase comes with instant notifications, and you can easily track your earnings from the dashboard');

        $this->migrator->add('general.join_us_title_ar', '');
        $this->migrator->add('general.join_us_title_en', '');
        $this->migrator->add('general.join_us_desc_ar', '');
        $this->migrator->add('general.join_us_desc_en', '');

        $this->migrator->add('general.products_desc_ar', '');
        $this->migrator->add('general.products_desc_en', '');

        $this->migrator->add('general.offers_desc_ar', '');
        $this->migrator->add('general.offers_desc_en', '');

        $this->migrator->add('general.stores_desc_ar', '');
        $this->migrator->add('general.stores_desc_en', '');

        $this->migrator->add('general.cart_desc_ar', '');
        $this->migrator->add('general.cart_desc_en', '');

        $this->migrator->add('general.partners_desc_ar', '');
        $this->migrator->add('general.partners_desc_en', '');

        $this->migrator->add('general.questions_desc_ar', '');
        $this->migrator->add('general.questions_desc_en', '');

        $this->migrator->add('general.contacts_desc_ar', '');
        $this->migrator->add('general.contacts_desc_en', '');
        $this->migrator->add('general.contacts_banner', '');

        $this->migrator->add('general.subscribe_header_ar', '');
        $this->migrator->add('general.subscribe_header_en', '');

        $this->migrator->add('general.desc_header_ar', '');
        $this->migrator->add('general.desc_header_en', '');

        $this->migrator->add('general.footer_desc_ar', '');
        $this->migrator->add('general.footer_desc_en', '');

        $this->migrator->add('general.footer_logo', '');

        $this->migrator->add('general.copy_right_ar', '');
        $this->migrator->add('general.copy_right_en', '');

        $this->migrator->add('general.vision_ar', '');
        $this->migrator->add('general.vision_en', '');

        $this->migrator->add('general.message_ar', '');
        $this->migrator->add('general.message_en', '');

        $this->migrator->add('general.phone', '');
        $this->migrator->add('general.email', '');
        $this->migrator->add('general.whatsapp', '');
        $this->migrator->add('general.appStore', '');
        $this->migrator->add('general.googlePlay', '');
        $this->migrator->add('general.support_link', '');
        $this->migrator->add('general.facebook', '');
        $this->migrator->add('general.instagram', '');
        $this->migrator->add('general.address', '');
        $this->migrator->add('general.location', '');

        $this->migrator->add('general.policy_desc_ar', '');
        $this->migrator->add('general.policy_desc_en', '');
    }
};
