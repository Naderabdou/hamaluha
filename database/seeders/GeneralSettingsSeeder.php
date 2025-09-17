<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Settings\GeneralSettings;

class GeneralSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = app(GeneralSettings::class);

        $settings->site_name_ar = 'حملها';
        $settings->site_name_en = 'Hamellha';

        $settings->logo = 'This is my website';
        $settings->favicon = 'This is my website';

        $settings->hero_desc_ar = 'موقع الكترونى احترافى متعدد البائعين يتيح للبائعين عرض منتجاتهم وبيعها مباشرةً للمستخدمين';
        $settings->hero_desc_en = 'A professional online marketplace that allows multiple sellers to display and sell their products directly to users.';

        $settings->about_header_ar = 'حول شغفك إلى دخل';
        $settings->about_header_en = 'Turn your passion into income';
        $settings->about_desc_ar = 'منصة مبتكرة لبيع وشراء المنتجات الرقمية، تربط بين البائعين المبدعين والمشترين الباحثين عن محتوى ممي نوفر لك بيئة آمنة وسهلة الاستخدام، سواء كنت بائعًا تسعى لنشر إبداعك أو مشتريًا تبحث عن أدوات تسهّل عملك وتطورك.';
        $settings->about_desc_en = 'An innovative platform for buying and selling digital products, connecting creative sellers with buyers looking for high-quality content. We provide a safe and user-friendly environment, whether you are a seller looking to share your creativity or a buyer seeking tools to enhance your work and development.';

        $settings->journey_step1_title_ar = 'سجل حساب بائع';
        $settings->journey_step1_desc_ar = 'افتح حساب مجاني وقم بملفك الشخصي وتقدر تتابع منتجاتك الرقمية بكل سهولة';
        $settings->journey_step1_title_en = 'Create a Seller Account';
        $settings->journey_step1_desc_en = 'Open a free account, complete your profile, and easily manage your digital products';

        $settings->journey_step2_title_ar = 'ارفع منتجاتك الرقمية';
        $settings->journey_step2_desc_ar = 'حمل ملفاتك (كتب، قوالب، دورات، وسائل علاجية...) وحدد السعر المناسب لك';
        $settings->journey_step2_title_en = 'Upload Your Digital Products';
        $settings->journey_step2_desc_en = 'Upload your files (books, templates, courses, therapy tools...) and set the right price';

        $settings->journey_step3_title_ar = 'استقبل المبيعات';
        $settings->journey_step3_desc_ar = 'كل عملية شراء توصلك بإشعار فوري مع متابعة أرباحك بسهولة من لوحة التحكم';
        $settings->journey_step3_title_en = 'Receive Sales';
        $settings->journey_step3_desc_en = 'Every purchase comes with instant notifications, and you can easily track your earnings from the dashboard';

        $settings->join_us_title_ar = 'انضم الينا كبائع';
        $settings->join_us_title_en = 'Join Us as a Seller';
        $settings->join_us_desc_ar = 'حوّل أفكارك ومنتجاتك الرقمية إلى دخل حقيقي.';
        $settings->join_us_desc_en = 'Turn your digital ideas and products into real income.';

        $settings->products_desc_ar = 'استكشف مكتبتنا الرقمية المتنوعة التي تضم ملفات تعليمية، قوالب تصميم احترافية، كتب إلكترونية، ووسائل علاجية. كل ما تحتاجه في مكان واحد ليسهّل عليك التعلم، الإبداع، والعمل.';
        $settings->products_desc_en = 'Explore our diverse digital library, which includes educational files, professional design templates, e-books, and therapeutic tools. Everything you need in one place to facilitate learning, creativity, and work.';

        $settings->offers_desc_ar = 'اكتشف جميع المتاجر الرقمية في منصتنا وتعرف على صنّاع المحتوى المتنوعين. تصفح منتجاتهم بسهولة واختر ما يناسب احتياجاتك.';
        $settings->offers_desc_en = 'Explore all the digital stores on our platform and meet diverse content creators. Easily browse their products and choose what suits your needs.';

        $settings->stores_desc_ar = 'اكتشف جميع المتاجر الرقمية في منصتنا وتعرف على صنّاع المحتوى المتنوعين. تصفح منتجاتهم بسهولة واختر ما يناسب احتياجاتك.';
        $settings->stores_desc_en = 'Explore all the digital stores on our platform and meet diverse content creators. Easily browse their products and choose what suits your needs.';

        $settings->cart_desc_ar = 'استعرض منتجاتك المختارة في مكان واحد، عدّل الكمية أو احذف ما لا تحتاجه، ثم تابع لإتمام عملية الدفع بسهولة وأمان.';
        $settings->cart_desc_en = "Browse your selected products in one place, adjust the quantity or delete what you don't need, then proceed to complete the checkout process easily and securely.";

        $settings->partners_desc_ar = 'شركاؤنا هم جزء من نجاحنا، وبفضل تعاونهم بنقدر نوفر أفضل محتوى وتجربة لكل مستخدم.';
        $settings->partners_desc_en = 'Our partners are part of our success, and thanks to their cooperation, we are able to provide the best content and experience for every user.';

        $settings->questions_desc_ar = 'هنا هتلاقي إجابات على أكثر الأسئلة الشائعة بخصوص الشراء أو البيع على منصتنا. لو لسه محتاج مساعدة إضافية، فريق الدعم جاهز يرد عليك في أي وقت';
        $settings->questions_desc_en = 'Here you\'ll find answers to the most frequently asked questions about buying or selling on our platform. If you still need additional assistance, our support team is ready to answer you at any time.';

        $settings->contacts_desc_ar = 'لو عندك  استفسار أو شكوى؟ فريقنا موجود عشان يساعدك في أي وقت. اختار الطريقة الأنسب ليك وتواصل معانا بسهولة';
        $settings->contacts_desc_en = 'If you have a question or complaint, our team is here to help you at any time. Choose the method that best suits you and contact us easily.';
        $settings->contacts_banner = '';

        $settings->subscribe_header_ar = 'ابق على تواصل معنا ليصلك كل جديد';
        $settings->subscribe_header_en = 'Stay connected with us to receive all the latest updates';

        $settings->desc_header_ar = 'كن أول من يحصل على أحدث العقارات والعروض الحصرية!';
        $settings->desc_header_en = 'Be the first to get the latest properties and exclusive offers!';

        $settings->footer_desc_ar = 'منصّة رقمية متكاملة تجمع بين البائعين والمشترين لبيع وشراء المنتجات الرقمية بسهولة وأمان، مثل الملفات التعليمية، القوالب، والكتب الإلكترونية.';
        $settings->footer_desc_en = 'An integrated digital platform that brings together sellers and buyers to easily and securely buy and sell digital products, such as educational files, templates, and e-books.';

        $settings->footer_logo = '';

        $settings->copy_right_ar = 'جميع الحقوق محفوظة © 2025 - صنع بكل حب  ❤  فعامل جدارة';
        $settings->copy_right_en = 'All rights reserved © 2025 - Made with love ❤ by Jadara';

        $settings->vision_ar = ' أن نكون المنصة العربية الأولى لبيع وتحميل المنتجات الرقمية بسهولة وأمان';
        $settings->vision_en = 'To be the first Arab platform for selling and downloading digital products easily and securely.';

        $settings->message_ar = ' نربط صُنّاع المحتوى بالمستخدمين عبر تجربة شراء سلسة وموثوقة.';
        $settings->message_en = 'We connect content creators with users through a seamless and reliable purchasing experience.';

        $settings->phone = '+962 7 9999 9999';
        $settings->email = 'hamellha@gmail.com';
        $settings->whatsapp = '+962 7 9999 9999';
        $settings->appStore = 'https://www.apple.com/app-store/';
        $settings->googlePlay = 'https://play.google.com/store';
        $settings->support_link = 'https://support.hamellha.com';
        $settings->facebook = ' https://www.facebook.com/hamellha';
        $settings->instagram = ' https://www.instagram.com/hamellha';
        $settings->address = 'Riyadh, Saudi Arabia';
        $settings->location = ' This is my location';

        $settings->policy_desc_ar = 'سياسة الخصوصية وشروط الاستخدام';
        $settings->policy_desc_en = 'Privacy Policy and Terms of Use';

        $settings->save();
    }
}
