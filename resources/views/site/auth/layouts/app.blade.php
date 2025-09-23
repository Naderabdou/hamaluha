@include('site.auth.layouts.header')
<!-- BEGIN: Content-->
<div class="body_page d-flex flex-column justify-content-between">
    <main id="app">
        @yield('content')
    </main>
</div>
@include('site.auth.layouts.script')
