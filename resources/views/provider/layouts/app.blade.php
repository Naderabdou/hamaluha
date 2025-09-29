@include('provider.layouts.header')
<!-- BEGIN: Content-->

@include('provider.layouts.sidebar')

<div class="content-app">

    @include('provider.layouts.topbar')

    @yield('content')

</div>


<!-- END: Content-->
@include('provider.layouts.footer')
