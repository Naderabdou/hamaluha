@extends('site.layouts.app')

@section('title', $store->name)

@section('header-class', 'pages')

@section('content')
    <section class="store-product m-section">
        <div class="main-container">
            <!-- هيدر المتجر -->
            <div class="store-product-header">
                <img src="{{ $store->image_path }}" alt="{{ $store->name }}" />
                <h2>{{ $store->name }}</h2>
                <div class="rate">
                    <p>{{ $store->rate }}</p>
                    <i class="bi bi-star-fill"></i>
                </div>
                <p>{{ $store->desc }}</p>
                <a href="#" class="main_btn" data-bs-toggle="modal" data-bs-target="#chat">مراسلة</a>
            </div>

            <!-- المنتجات + الفلترة -->
            <div class="all-products">
                <div class="all-products-header">
                    <!-- البحث -->
                    <div class="search-product">
                        <form method="GET" action="{{ route('site.stores.show', $store->id) }}">
                            <img src="{{ asset('site/images/search-icon.svg') }}" alt="">
                            <input type="search" name="q" placeholder="ابحث فالمتجر" value="{{ request('q') }}">
                            <button type="submit" style="display:none;"></button>
                        </form>
                    </div>



                    <!-- زر التصفية -->
                    <div class="filter-product">
                        <a href="javascript:void(0)" class="main_btn" id="toggleFilter">تصفية</a>

                        <!-- بوكس الفلاتر -->
                        <div class="filters" id="filtersBox">
                            <form method="GET">
                                <!-- التصنيفات -->
                                <div class="filter-section">
                                    <h4>التصنيفات</h4>
                                    <label>
                                        <input type="checkbox" name="category" value=""
                                            {{ request('category') == '' ? 'checked' : '' }}>
                                        <span>الكل</span>
                                    </label>
                                    @foreach (\App\Models\Category::all() as $cat)
                                        <label>
                                            <input type="checkbox" name="category" value="{{ $cat->id }}"
                                                {{ request('category') == $cat->id ? 'checked' : '' }}>
                                            <span>{{ $cat->name }}</span>
                                        </label>
                                    @endforeach
                                </div>

                                <!-- السعر -->
                                <div class="filter-section">
                                    <h4>السعر</h4>
                                    <div class="price-inputs">
                                        <input type="number" name="min_price" min="0"
                                            value="{{ request('min_price') }}">
                                        <span>الى</span>
                                        <input type="number" name="max_price" min="0"
                                            value="{{ request('max_price') }}">
                                        <img src="{{ asset('site/images/ryal.svg') }}" alt="">
                                    </div>
                                </div>

                                <!-- تقييم المنتج -->
                                <div class="filter-section">
                                    <h4>تقييم المنتج</h4>
                                    <input type="range" name="rate" min="1" max="5"
                                        value="{{ request('rate', 5) }}" step="1" class="range">
                                    <div class="range-labels">
                                        <span>1</span>
                                        <span>5</span>
                                    </div>
                                </div>

                                <!-- الخصومات -->
                                <div class="filter-section">
                                    <h4>الخصومات</h4>
                                    <label>
                                        <input type="checkbox" name="discount" value="1"
                                            {{ request('discount') ? 'checked' : '' }}>
                                        <span>المنتجات المخفضة</span>
                                    </label>
                                </div>

                                <button type="submit" class="main_btn">تطبيق الفلترة</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- عرض المنتجات -->
                <div class="row">
                    @foreach ($products as $prod)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                            <div class="best-seller-card">
                                <div class="card-img">
                                    <div class="rate">
                                        <p>{{ number_format($prod->reviews->avg('rating'), 1) ?? 0 }}</p>
                                        <i class="bi bi-star-fill"></i>
                                    </div>

                                    <div class="favourite-icon">
                                        @if (auth()->check() && in_array($prod->id, $favorites))
                                            <i class="bi bi-heart-fill text-danger"></i>
                                        @else
                                            <i class="bi bi-heart-fill"></i>
                                        @endif
                                    </div>



                                    <img src="{{ $prod->first_image->image_path }}" alt="{{ $prod->name }}">

                                </div>
                                <div class="card-body">
                                    <span>{{ $store->name }}</span>
                                    <span>{{ $prod->name }}</span>
                                    <p>{{ Str::limit($prod->desc, 60) }}</p>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="main_btn">اضف الى السلة</a>
                                    <div class="price">
                                        <img src="{{ asset('site/images/ryal.svg') }}" alt="">
                                        {{ $prod->price }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                <!-- الباجينيشن -->
                <div class="pagination-wrapper">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection
