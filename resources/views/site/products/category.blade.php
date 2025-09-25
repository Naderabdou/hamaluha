@extends('site.layouts.app')
@section('title', __('Our Products'))

@section('header-class', 'pages')
@section('content')
    <!-- out products -->
    <section class="our-products">
        <div class="main-container">
            <h2 class="sub-title">{{ $category->name }}</h2>
            <p class="sub-paragraph">
                {{ $category->desc }}
            </p>



            <!--  -->
            <div class="category-details">
                <div class="best-seller-owl-containrt">
                    <div class="category-details-owl owl-carousel owl-theme">
                        @forelse($category->children as $subCategory)
                            <div class="item">
                                <div class="category-details-card">
                                    <div class="card-img">
                                        <img src="{{ $subCategory->image_path }}" alt="{{ $subCategory->name }}" />
                                    </div>
                                    <h3>{{ $subCategory->name }}</h3>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>

                <!--  -->
                <div class="all-products">
                    <div class="all-products-header">
                        <div class="search-product">
                            <img src="{{ asset('site') }}/images/search-icon.svg" alt="">
                            <input type="search" placeholder="ابحث فالمتجر">
                        </div>
                        <div class="filter-product">
                            <a href="javascript:void(0)" class="main_btn" id="toggleFilter">
                                تصفية
                            </a>

                            <div class="filters" id="filtersBox">

                                <!-- التصنيفات -->
                                <div class="filter-section">
                                    <h4>التصنيفات</h4>
                                    <label><input type="checkbox"> <span>الكل</span></label>
                                    @forelse ($categories as $category)
                                        <label><input type="checkbox" checked><span>{{ $category->name }}</span></label>
                                        <div class="sub">
                                            @forelse ($category->children as $subCategory)
                                                <label><input type="checkbox"><span>{{$subCategory->name}}</span></label>
                                            @empty
                                            @endforelse
                                        </div>
                                    @empty

                                    @endforelse
                                </div>

                                <!-- السعر -->
                                <div class="filter-section">
                                    <h4>السعر</h4>
                                    <div class="price-inputs">
                                        <input type="number" min="0" value="10">
                                        <span>الى</span>
                                        <input type="number" min="0" value="30">
                                        <img src="{{ asset('site') }}/images/ryal.svg" alt="">
                                    </div>
                                </div>

                                <!-- تقييم المنتج -->
                                <div class="filter-section">
                                    <h4>تقييم المنتج</h4>
                                    <input type="range" min="1" max="5" value="5" step="1"
                                        class="range">
                                    <div class="range-labels">
                                        <span>1</span>
                                        <span>5</span>
                                    </div>
                                </div>

                                <!-- الخصومات -->
                                <div class="filter-section">
                                    <h4>الخصومات</h4>
                                    <label><input type="checkbox"> <span>المنتجات المخفضة</span></label>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="row">



                        @forelse ($products as $product)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">

                                <a href="{{ route('site.products.show', $product->slug) }}" class="best-seller-card">
                                    <div class="card-img">
                                        <div class="rate">
                                            <p>
                                                {{ $product->average_rating }}
                                            </p>
                                            <i class="bi bi-star-fill"></i>
                                        </div>

                                        <div class="favourite-icon ">
                                            <i class="bi bi-heart-fill"></i>
                                        </div>
                                        <img src="{{ $product->first_image->image_path }}" alt="" />
                                    </div>
                                    <div class="card-body">
                                        <span>{{ $product->store->name }}</span>
                                        <h3>{{ $product->name }}</h3>
                                        <p>
                                            {{ $product->desc }}
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="main_btn">
                                            اضف الى السلة
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.3346 10.9997C11.6883 10.9997 12.0274 11.1402 12.2774 11.3902C12.5275 11.6402 12.668 11.9794 12.668 12.333C12.668 12.6866 12.5275 13.0258 12.2774 13.2758C12.0274 13.5259 11.6883 13.6663 11.3346 13.6663C10.981 13.6663 10.6419 13.5259 10.3918 13.2758C10.1418 13.0258 10.0013 12.6866 10.0013 12.333C10.0013 11.593 10.5946 10.9997 11.3346 10.9997ZM0.667969 0.333008H2.84797L3.47464 1.66634H13.3346C13.5114 1.66634 13.681 1.73658 13.806 1.8616C13.9311 1.98663 14.0013 2.1562 14.0013 2.33301C14.0013 2.44634 13.968 2.55967 13.9213 2.66634L11.5346 6.97967C11.308 7.38634 10.868 7.66634 10.368 7.66634H5.4013L4.8013 8.75301L4.7813 8.83301C4.7813 8.87721 4.79886 8.9196 4.83012 8.95086C4.86137 8.98212 4.90377 8.99967 4.94797 8.99967H12.668V10.333H4.66797C4.31435 10.333 3.97521 10.1925 3.72516 9.94248C3.47511 9.69244 3.33464 9.3533 3.33464 8.99967C3.33464 8.76634 3.39464 8.54634 3.49464 8.35967L4.4013 6.72634L2.0013 1.66634H0.667969V0.333008ZM4.66797 10.9997C5.02159 10.9997 5.36073 11.1402 5.61078 11.3902C5.86083 11.6402 6.0013 11.9794 6.0013 12.333C6.0013 12.6866 5.86083 13.0258 5.61078 13.2758C5.36073 13.5259 5.02159 13.6663 4.66797 13.6663C4.31435 13.6663 3.97521 13.5259 3.72516 13.2758C3.47511 13.0258 3.33464 12.6866 3.33464 12.333C3.33464 11.593 3.92797 10.9997 4.66797 10.9997ZM10.668 6.33301L12.5213 2.99967H4.09464L5.66797 6.33301H10.668Z"
                                                    fill="white" />
                                            </svg>
                                        </button>
                                        <div class="price">
                                            <img src="{{ asset('site') }}/images/ryal.svg" alt="" />
                                            {{ $product->price }}
                                        </div>

                                    </div>
                                </a>
                            </div>
                        @empty
                            <p>لا توجد منتجات لعرضها.</p>
                        @endforelse

                    </div>
                </div>
            </div>
    </section>
@endsection
