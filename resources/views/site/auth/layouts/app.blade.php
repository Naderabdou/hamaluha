<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    @include('site.auth.layouts.header')
    <body>
        <div class="body_page d-flex flex-column justify-content-between">
            <main id="app">
                <!-- BEGIN: Content-->
                @yield('content')
                <!-- END: Content-->
            </main>
        </div>
        @include('site.auth.layouts.script')
    </body>
</html>
