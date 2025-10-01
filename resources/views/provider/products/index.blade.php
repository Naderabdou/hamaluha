@extends('provider.layouts.app')
@section('title', __('Home'))
{{-- @title($settings->{'site_name_' . app()->getLocale()})
@description($settings->{'about_desc_' . app()->getLocale()})
@image(asset('storage/' . $settings->logo)) --}}
@section('content')
    <div class="app-data">
        <!--  -->
        <section class="most-requested">
            <div class="requested-header">
                <h2 class="sub-header"> كل المنتجات </h2>
                <div class="filter-product">
                    <a href="javascript:void(0)" class="main_btn" id="toggleFilter">
                        تصفية
                    </a>

                    <div class="filters" id="filtersBox">
                        <!-- التصنيفات -->
                        <div class="filter-section">
                            <h4>التصنيفات</h4>
                            <label><input type="checkbox" /> <span>الكل</span></label>
                            <label><input type="checkbox" checked /><span>
                                    التصميم والإبداع</span></label>
                            <div class="sub">
                                <label><input type="checkbox" /><span>
                                        أدوات للمصممين</span></label>
                                <label><input type="checkbox" checked />
                                    <span>قوالب تصميم</span></label>
                                <label><input type="checkbox" />
                                    <span>صور وفوتوغرافيا رقمية</span></label>
                            </div>
                            <label><input type="checkbox" /><span>
                                    الك تب الإلكترونية</span></label>
                        </div>

                        <!-- السعر -->
                        <div class="filter-section">
                            <h4>السعر</h4>
                            <div class="price-inputs">
                                <input type="number" min="0" value="10" />
                                <span>الى</span>
                                <input type="number" min="0" value="30" />
                                <img src="{{ asset('site') }}/images/ryal.svg" alt="" />
                            </div>
                        </div>

                        <!-- تقييم المنتج -->
                        <div class="filter-section">
                            <h4>تقييم المنتج</h4>
                            <input type="range" min="1" max="5" value="5" step="1"
                                class="range" />
                            <div class="range-labels">
                                <span>1</span>
                                <span>5</span>
                            </div>
                        </div>

                        <!-- الخصومات -->
                        <div class="filter-section">
                            <h4>الخصومات</h4>
                            <label><input type="checkbox" />
                                <span>المنتجات المخفضة</span></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-lg-4 col-md-6 ">
                        <div class="requested-card">
                            <div class="more-setting">
                                <img src="{{ asset('site') }}/images/more-vertical.svg" alt="" class="more-btn" />

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('site.provider.products.show', $product) }}">
                                            <img src="{{ asset('site') }}/images/pencil-edit-02.svg" alt="" />
                                            <span>عرض المنتج </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('site.provider.products.edit', $product) }}">
                                            <img src="{{ asset('site') }}/images/pencil-edit-02.svg" alt="" />
                                            <span>تعديل المنتج </span>
                                        </a>
                                    </li>
                                    <li class="delete">
                                        <a href="{{ route('site.provider.products.destroy', $product) }}">

                                            <img src="{{ asset('site') }}/images/delete-card.svg" alt="" />
                                            <span>حذف</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="img-container">w
                                <div class="requested-title">
                                    <p>{{ $product->name }}</p>
                                    <span> {{ $product->category->name }} / {{ $product->category->parent->name }}
                                    </span>
                                </div>
                                @if ($product->offers()->first())
                                    <label for=""> {{ $product->offers()->first()->discount }}%</label>
                                @endif
                                <img src="{{ $product->first_image->image_path }}" alt="" />
                            </div>
                            <div class="requested-body">
                                <div class="body-item">
                                    <div class="item-container">
                                        <div class="item-card price">
                                            <p>سعر المنتج</p>
                                            @if ($product->discounted_price)
                                                <span>
                                                    {{ $product->discounted_price }}
                                                    <p>{{ $product->price }}</p>
                                                    <img src="{{ asset('site') }}/images/ryal.svg" alt="" />
                                                </span>
                                            @else
                                                <span>
                                                    {{ $product->price }}
                                                    <img src="{{ asset('site') }}/images/ryal.svg" alt="" />
                                                </span>
                                            @endif
                                        </div>
                                        <!--  -->
                                        <div class="item-card">
                                            <p>عدد مرات التحميل</p>
                                            <span> {{ $product->orders_number }} </span>
                                        </div>
                                        <!--  -->
                                        <div class="item-card">
                                            <p>اجمالى المبيعات</p>
                                            <span>
                                                {{ $product->total_sales }} <img src="{{ asset('site') }}/images/ryal.svg"
                                                    alt="" />
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </section>
    </div>
@endsection
