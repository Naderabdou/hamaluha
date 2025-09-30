@extends('provider.layouts.app')
@section('title', __('Home'))
{{-- @title($settings->{'site_name_' . app()->getLocale()})
@description($settings->{'about_desc_' . app()->getLocale()})
@image(asset('storage/' . $settings->logo)) --}}
@section('content')
    <div class="app-data">
        <!-- cards -->
        <div class="admin-statistic-cards">
            <div class="row">
                <div class="col-4">
                    <div class="statistic-cards">
                        <p>{{ $orders_count }}</p>
                        <span>{{ __('Orders Count') }}</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="statistic-cards">
                        <p>{{ $products_count }}</p>
                        <span>{{ __('Total Products') }}</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="statistic-cards">
                        <p>{{ $total_revenue }}</p>
                        <span>{{ __('Total Revenue') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <section class="most-requested">
            <div class="requested-header">
                <h2 class="sub-header">المنتجات الاكثر طلبا</h2>
            </div>
            <div class="row">
                @forelse ($bestSellers as $bestSeller)
                    <div class="col-lg-4 col-md-6 ">
                        <div class="requested-card">
                            <div class="more-setting">
                                <img src="{{ asset('site') }}/images/more-vertical.svg" alt="" class="more-btn" />

                                <ul class="dropdown-menu">
                                    <li>
                                        <img src="{{ asset('site') }}/images/cancel.svg" alt="" />
                                        <span>عرض المنتج </span>
                                    </li>
                                    <li>
                                        <img src="{{ asset('site') }}/images/pencil-edit-02.svg" alt="" />
                                        <span>عرض التعليقات</span>
                                    </li>
                                    <li>
                                        <img src="{{ asset('site') }}/images/pencil-edit-02.svg" alt="" />
                                        <span>اضافة خصم</span>
                                    </li>
                                    <li class="delete">
                                        <img src="{{ asset('site') }}/images/delete-card.svg" alt="" />
                                        <span>حذف</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="img-container">
                                <div class="requested-title">
                                    <p>{{ $bestSeller->name }}</p>
                                    <span> {{ $bestSeller->category->name }} / {{ $bestSeller->category->parent->name }}
                                    </span>
                                </div>
                                <label for=""> 20%</label>
                                <img src="{{ asset('site') }}/images/requested.png" alt="" />
                            </div>
                            <div class="requested-body">
                                <div class="body-item">
                                    <div class="item-container">
                                        <div class="item-card price">
                                            <p>سعر المنتج</p>
                                            @if ($bestSeller->discounted_price)
                                                <span>
                                                    {{ $bestSeller->discounted_price }}
                                                    <p>{{ $bestSeller->price }}</p>
                                                    <img src="{{ asset('site') }}/images/ryal.svg" alt="" />
                                                </span>
                                            @else
                                                <span>
                                                    {{ $bestSeller->price }}
                                                    <img src="{{ asset('site') }}/images/ryal.svg" alt="" />
                                                </span>
                                            @endif
                                        </div>
                                        <!--  -->
                                        <div class="item-card">
                                            <p>عدد مرات التحميل</p>
                                            <span> {{ $bestSeller->orders_number }} </span>
                                        </div>
                                        <!--  -->
                                        <div class="item-card">
                                            <p>اجمالى المبيعات</p>
                                            <span>
                                                {{ $bestSeller->total_sales }} <img
                                                    src="{{ asset('site') }}/images/ryal.svg" alt="" />
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

        <section class="most-requested latest-offers">
            <div class="requested-header">
                <h2 class="sub-header">{{ __('احدث العروض') }}</h2>
            </div>
            <div class="row">
                @forelse ($latestOffers as $offer)
                    <div class="col-lg-6 col-md-6 ">
                        <div class="requested-card">
                            <div class="more-setting">
                                <svg class="more-btn" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 6.75C11.5858 6.75 11.25 6.41421 11.25 6C11.25 5.58579 11.5858 5.25 12 5.25C12.4142 5.25 12.75 5.58579 12.75 6C12.75 6.41421 12.4142 6.75 12 6.75Z"
                                        stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M12 12.75C11.5858 12.75 11.25 12.4142 11.25 12C11.25 11.5858 11.5858 11.25 12 11.25C12.4142 11.25 12.75 11.5858 12.75 12C12.75 12.4142 12.4142 12.75 12 12.75Z"
                                        stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M12 18.75C11.5858 18.75 11.25 18.4142 11.25 18C11.25 17.5858 11.5858 17.25 12 17.25C12.4142 17.25 12.75 17.5858 12.75 18C12.75 18.4142 12.4142 18.75 12 18.75Z"
                                        stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>


                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="">
                                            <img src="{{ asset('site') }}/images/pencil-edit-02.svg" alt="" />
                                            <span>عرض المنتج </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <img src="{{ asset('site') }}/images/star.svg" alt="" />
                                            <span>عرض التعليقات</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <img src="{{ asset('site') }}/images/discount.svg" alt="" />
                                            <span>اضافة خصم</span>
                                        </a>
                                    </li>
                                    <a href="">
                                        <li class="delete">
                                            <img src="{{ asset('site') }}/images/delete-card.svg" alt="" />
                                            <span>حذف</span>
                                        </li>
                                    </a>
                                </ul>
                            </div>
                            <div class="requested-card-header">
                                <div class="img-container">

                                    <img src="{{ $offer->image_path }}" alt="" />
                                </div>
                                <p>
                                    {{ $offer->desc }}
                                </p>
                            </div>
                            <div class="requested-body">
                                <div class="body-item">
                                    <div class="item-container">
                                        <div class="item-card">
                                            <p> بداية الخصم </p>
                                            <span> 5/9/2025</span>
                                        </div>
                                        <!--  -->
                                        <div class="item-card">
                                            <p>نهاية الخصم </p>
                                            <span> 5/9/2025 </span>
                                        </div>
                                        <!--  -->
                                        <div class="item-card status">
                                            <p> حالة العرض</p>
                                            @if ($offer->is_active)
                                                <span> سارى </span>
                                            @else
                                                <span class="text-danger"> منتهي </span>
                                            @endif
                                        </div>
                                        <!--  -->
                                        <div class="item-card discount">
                                            <p> نسبة الخصم</p>
                                            <span> {{ $offer->discount }}% </span>
                                        </div>
                                    </div>
                                    <div class="item-container">
                                        <div class="item-card">
                                            <p>عدد المنتجات </p>
                                            <span> {{ $offer->products->count() }} </span>
                                        </div>
                                        <div class="item-card price">
                                            <p>سعر العرض</p>
                                            <span>
                                                {{ $offer->products->sum('price') }}
                                                <p>{{ $offer->products->sum('price') }}</p>
                                                <img src="{{ asset('site') }}/images/ryal.svg" alt="" />
                                            </span>
                                        </div>
                                        <!--  -->
                                        <div class="item-card">
                                            <p> عدد الطلبات </p>
                                            <span> {{ $offer->sales_count }} </span>
                                        </div>
                                        <!--  -->
                                        <div class="item-card">
                                            <p>اجمالى المبيعات</p>
                                            <span>
                                                2000 <img src="{{ asset('site') }}/images/ryal.svg" alt="" />
                                            </span>
                                        </div>
                                        <!--  -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse


            </div>
        </section>

        <!-- last-comments -->

        <section class="last-comments">
            <div class="requested-header">
                <h2 class="sub-header"> احدث التعليقات</h2>
            </div>
            <div class="row">
                @forelse ($latestReviews as $review)
                    <div class="col-lg-6 col-md-12">
                        <div class="comment-card">
                            <div class="comment-card-header">

                                <div class="img-container">

                                    <img src="{{ $review->product->first_image->image_path }}" alt="" />
                                </div>
                                <div class="comment-writer">
                                    <div class="writer-info">
                                        <img src="{{ $review->user->name }}" alt="">
                                        <p>
                                            {{ $review->user->name }}
                                        </p>
                                    </div>
                                    <p>
                                        {{ $review->comment }}
                                    </p>
                                </div>
                                <div class="date">
                                    <p>
                                        {{ $review->created_at_human }}
                                    </p>
                                </div>
                            </div>
                            <div class="comment-body">
                                <div class="img-container">
                                    <img src="{{ auth()->user()->store }}" alt="">
                                </div>
                                <div class="comment-input">
                                    <input type="text">
                                    <img src="{{ asset('site') }}/images/send.svg" alt="">
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
