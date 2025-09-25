@extends('site.layouts.app')
@section('title', __('Our Products'))

@section('header-class', 'pages')
@section('content')
    <!-- out products -->
    <section class="our-products">
        <div class="main-container">
            <h2 class="sub-title">{{ __('منتجاتنا') }}</h2>
            <p class="sub-paragraph">
                {{ $settings->{'products_desc_' . app()->getLocale()} }}
            </p>
            <div class="our-products-items">
                @forelse ($categories as $category)
                    <a href="{{ route('site.category.products', $category->slug) }}" class="products-item">
                        <div class="item-img">
                            <img src="{{ $category->image_path }}" alt="{{ $category->name }}" />
                        </div>
                        <p>{{ $category->name }}</p>
                    </a>
                @empty
                    <p>{{__('لا توجد تصنيفات لعرضها.')}}</p>
                @endforelse
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
                            {{__('تصفية')}}
                        </a>

                        <div class="filters" id="filtersBox">

                            <!-- التصنيفات -->
                            <div class="filter-section">
                                <h4>{{__('التصنيفات')}}</h4>
                                <label>
                                    <input type="checkbox" value="all" class="category-filter"> <span>{{__('الكل')}}</span>
                                </label>

                                @forelse ($categories as $category)
                                    <label>
                                        <input type="checkbox" value="{{ $category->slug }}" class="category-filter">
                                        <span>{{ $category->name }}</span>
                                    </label>

                                    <div class="sub">
                                        @forelse ($category->children as $subCategory)
                                            <label>
                                                <input type="checkbox" value="{{ $subCategory->slug }}"
                                                    class="category-filter">
                                                <span>{{ $subCategory->name }}</span>
                                            </label>
                                        @empty
                                        @endforelse
                                    </div>
                                @empty
                                @endforelse
                            </div>


                            <!-- السعر -->
                            <div class="filter-section">
                                <h4>{{__('السعر')}}</h4>
                                <div class="price-inputs">
                                    <input type="number" min="0" value="10">
                                    <span>{{__('الى')}}</span>
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
                                <h4>{{__('الخصومات')}}</h4>
                                <label><input type="checkbox"> <span>{{__('المنتجات المخفضة')}}</span></label>
                            </div>
                        </div>


                    </div>
                </div>
                @include('site.products.partials.products')
            </div>
        </div>
    </section>

@endsection
