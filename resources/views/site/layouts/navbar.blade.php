    <header class="@yield('header-class')">
        <div class="main-container">
            <!-- left-books -->
            @yield('header-books')



            <nav>
                <a href="{{ route('site.home') }}" class="logo">
                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="" />
                </a>

                <div class="nav-elements">
                    <ul>
                        <li class="active">
                            <a href="{{ route('site.home') }}">الرئيسية</a>
                        </li>
                        <li>
                            <a href="{{ route('site.about') }}">النبذة</a>
                        </li>
                        <li>
                            <a href="./our-products.html">المنتجات</a>
                        </li>
                        <li>
                            <a href="./stores.html">المتاجر</a>
                        </li>
                        <li>
                            <a href="./offers.html">العروض</a>
                        </li>
                        <li>
                            <a href="./index.html#contact">تواصل معنا</a>
                        </li>
                    </ul>
                </div>
                <div class="nav-actions">
                    @auth()
                        <a href="#" class="links-actions">
                            <img src="{{ asset('site/images/cart-nav.svg') }}" alt="" />
                        </a>
                        <a href="#" class="links-actions">
                            <img src="{{ asset('site/images/fovourite.svg') }}" alt="" />
                        </a>
                        <a href="#" class="avatar">
                            <img src="{{ asset('site/images/avatar.svg') }}" alt="" />
                        </a>

                        @if (!auth()->user()->hasStoreRequest())
                            <a href="" class="main_btn" data-bs-toggle="modal" data-bs-target="#join"> انضم كبائع </a>
                        @endif
                    @endauth

                    @guest()
                        <a href="{{ route('site.login') }}" class="main_btn"> تسجيل الدخول</a>

                        <a href="{{ route('site.register') }}" class="main_btn"> انشاء حساب</a>
                    @endguest
                </div>


                <!-- responsive menu -->
                <div class="show-menu">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </nav>
            @yield('header-hero')

        </div>
    </header>
