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
                            <a href="{{ route('site.about') }}" class="{{ isActiveRoute('site.about') }}">النبذة</a>
                        </li>
                        <li>
                            <a href="{{ route('site.products.index') }}">المنتجات</a>
                        </li>
                        <li>
                            <a href="{{ route('site.stores.index') }}" class="{{ isActiveRoute('site.stores.index') }}">المتاجر</a>
                        </li>
                        <li>
                            <a href="{{ route('site.offers.index') }}">العروض</a>
                        </li>
                        {{-- <li>
                            <a href="./index.html#contact">تواصل معنا</a>
                        </li> --}}
                    </ul>
                </div>
                <div class="nav-actions">
                    @auth()
    <a href="{{ route('site.cart.index') }}" class="links-actions position-relative">
                <img src="{{ asset('site/images/cart-nav.svg') }}" alt="" />

                @php
                    $cart = session('cart', []);
                    $count = array_sum(array_column($cart, 'quantity')); // مجموع الكمية
                @endphp

                    @if ($count > 0)
                                    <span class="cart-count">{{ $count }}</span>
                                    @endif
                                </a>

                                <a href="{{ route('site.favourites.index') }}"
                                    class="links-actions {{ isActiveRoute('site.favourites.index') }}">
                                    <img src="{{ asset('site/images/fovourite.svg') }}" alt="" />
                                </a>
                                <a href="{{ route('site.profile') }}" class="avatar">
                                    <img src="{{ asset('site/images/avatar.svg') }}" alt="" />
                                </a>

                                @if (!auth()->user()->hasStoreRequest())
                                    <a href="" class="main_btn" data-bs-toggle="modal" data-bs-target="#join"> انضم
                                        كبائع </a>
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
