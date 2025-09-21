<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    @include('site.user.layouts.header')
    <body>
        <div class="body_page d-flex flex-column justify-content-between">
            <main id="app">

                @include('site.user.layouts.navbar')

                <!-- BEGIN: Content-->
                @yield('content')
                <!-- END: Content-->

                @include('site.user.layouts.footer')
            </main>
        </div>
        @include('site.user.layouts.script')
    </body>
</html>
