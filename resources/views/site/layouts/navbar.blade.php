    <header class="@yield('header-class')">
        <div class="main-container">
            <!-- left-books -->
            @yield('header-books')



            <nav>
                <a href="./index.html" class="logo">
                    <img src="./images/logo.png" alt="" />
                </a>

                <div class="nav-elements">
                    <ul>
                        <li class="active">
                            <a href="./index.html">الرئيسية</a>
                        </li>
                        <li>
                            <a href="./about.html">النبذة</a>
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
                    <a href="./cart.html" class="links-actions">
                        <img src="./images/cart-nav.svg" alt="" />
                    </a>
                    <a href="./favourite.html" class="links-actions">
                        <img src="./images/fovourite.svg" alt="" />
                    </a>
                    <a href="./profile.html" class="avatar">
                        <img src="./images/avatar.svg" alt="" />
                    </a>

                    <a href="" class="main_btn" data-bs-toggle="modal" data-bs-target="#join"> انضم كبائع </a>
                </div>

                <!-- responsive menu -->
                <div class="show-menu">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </nav>
            @yield('header-hero')

        </div>
    </header>
