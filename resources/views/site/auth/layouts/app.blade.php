@include('site.auth.layouts.header')
<!-- BEGIN: Content-->
<div class="body_page d-flex flex-column justify-content-between">
    @yield('content')
</div>
@include('site.auth.layouts.script')
