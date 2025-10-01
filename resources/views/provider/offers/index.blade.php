@extends('provider.layouts.app')
@section('title', 'العروض')

@section('content')
    <div class="app-data">
        <!-- المنتجات الأكثر طلبا -->
        <section class="most-requested latest-offers">
            <div class="requested-header">
                <h2 class="sub-header"> العروض</h2>
                <a href="{{ route('site.provider.all') }}">عرض الكل </a>

            </div>
            <div class="row">
                @foreach ($offers as $offer)
                    <div class="col-lg-6 col-md-6">
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
                                        <img src="#" alt="" />
                                        <a href="{{ route('site.provider.offers.show', $offer->id) }}">
                                            <span>عرض المنتج</span>
                                        </a>
                                    </li>
                                    <li>
                                        <img src="#" alt="" />
                                        <a href="{{ route('site.provider.activate', $offer->id) }}">
                                            <span>تفعيل العرض</span>
                                        </a>
                                    </li>
                                    <li>
                                        <img src="#" alt="" />
                                        <a href="{{ route('site.provider.pause', $offer->id) }}">
                                            <span>إيقاف العرض</span>
                                        </a>
                                    </li>

                                    <li class="delete">
                                        <img src="#" alt="" />
                                        <a href="{{ route('site.provider.offers.edit', $offer->id) }}">
                                            <span>تعديل العرض</span>
                                        </a>

                                    </li>
                                </ul>
                            </div>

                            <div class="requested-card-header">
                                <div class="img-container">
                                    <img src="{{ $offer->image ? asset('storage/' . $offer->image) : asset('images/default.png') }}"
                                        alt="offer">
                                </div>
                                <p>{{ $offer->desc_ar ?? $offer->desc_en }}</p>
                            </div>

                            <div class="requested-body">
                                <div class="body-item">
                                    <div class="item-container">
                                        <div class="item-card">
                                            <p>بداية الخصم</p>
                                            <span>{{ \Carbon\Carbon::parse($offer->start_at)->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="item-card">
                                            <p>نهاية الخصم</p>
                                            <span>{{ \Carbon\Carbon::parse($offer->end_at)->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="item-card status">
                                            <p>حالة العرض</p>
                                            <span>
                                                @if (now() < $offer->start_at)
                                                    لم يبدأ
                                                @elseif(now() > $offer->end_at)
                                                    منتهي
                                                @else
                                                    ساري
                                                @endif
                                            </span>
                                        </div>
                                        <div class="item-card discount">
                                            <p>نسبة الخصم</p>
                                            <span>
                                                @if ($offer->type === 'offer')
                                                    {{ intval($offer->discount) }}%
                                                @else
                                                    {{ $offer->discount }} ريال
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <div class="item-container">
                                        <div class="item-card">
                                            <p>عدد المنتجات</p>
                                            <span>{{ $offer->products->count() }}</span>
                                        </div>
                                        <div class="item-card price">
                                            <p>سعر المنتج بعد الخصم</p>
                                            @php
                                                $totalPrice = $offer->products->sum('price');
                                                $finalPrice =
                                                    $offer->type === 'offer'
                                                        ? $totalPrice - ($totalPrice * $offer->discount) / 100
                                                        : $totalPrice - $offer->discount;
                                            @endphp
                                            <span>{{ $finalPrice }} <img src="{{ asset('site/images/ryal.svg') }}"
                                                    alt=""></span>
                                        </div>
                                        <div class="item-card">
                                            <p>عدد الطلبات</p>
                                            <span>{{ $offer->orders_count ?? 0 }}</span>
                                        </div>
                                        <div class="item-card">
                                            <p>اجمالى المبيعات</p>
                                            <span>{{ $offer->sales_total ?? 0 }} <img
                                                    src="{{ asset('site/images/ryal.svg') }}" alt=""></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- كل المنتجات المخفضة -->
        <section class="most-requested">
            <div class="requested-header">
                <h2 class="sub-header">كل المنتجات المخفضة</h2>
                <a href="{{ route('site.provider.all') }}">عرض الكل</a>
            </div>
            <div class="row">
                @foreach ($offers->skip(1) as $offer)
                    <div class="col-lg-4 col-md-6">
                        <div class="requested-card">
                            <div class="more-setting">
                                <img src="{{ asset('site/images/more-vertical.svg') }}" alt="" class="more-btn" />
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('site.provider.discounted', $offer->id) }}">
                                            <span>عرض المنتج</span>
                                        </a>


                                    </li>

                                </ul>
                            </div>
                            <div class="img-container">
                                <div class="requested-title">
                                    <p>{{ $offer->desc_ar ?? $offer->desc_en }}</p>
                                    <span>{{ $offer->category->name ?? '' }}</span>
                                </div>
                                <img src="{{ $offer->image ? asset('storage/' . $offer->image) : asset('images/default.png') }}"
                                    alt="offer">
                            </div>
                            <div class="requested-body">
                                <div class="body-item">
                                    <div class="item-container">
                                        <div class="item-card">
                                            <p>تاريخ الإضافة</p>
                                            <span>{{ \Carbon\Carbon::parse($offer->created_at)->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="item-card">
                                            <p>عدد مرات التحميل</p>
                                            <span>{{ $offer->downloads_count ?? 0 }}</span>
                                        </div>
                                        <div class="item-card discount">
                                            <p>نسبة الخصم</p>
                                            <span>
                                                @if ($offer->type === 'offer')
                                                    {{ intval($offer->discount) }}%
                                                @else
                                                    {{ $offer->discount }} ريال
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="item-container">
                                        <div class="item-card price">
                                            <p>سعر المنتج بعد الخصم</p>
                                            @php
                                                $totalPrice = $offer->products->sum('price');
                                                $finalPrice =
                                                    $offer->type === 'offer'
                                                        ? $totalPrice - ($totalPrice * $offer->discount) / 100
                                                        : $totalPrice - $offer->discount;
                                            @endphp
                                            <span>{{ $finalPrice }} <img src="{{ asset('site/images/ryal.svg') }}"
                                                    alt=""></span>
                                        </div>
                                        <div class="item-card">
                                            <p>إجمالي المبيعات</p>
                                            <span>{{ $offer->sales_total ?? 0 }} <img
                                                    src="{{ asset('site/images/ryal.svg') }}" alt=""></span>
                                        </div>
                                        <div class="item-card status">
                                            <p>حالة العرض</p>
                                            <span>
                                                @if (now() < $offer->start_at)
                                                    لم يبدأ
                                                @elseif(now() > $offer->end_at)
                                                    منتهي
                                                @else
                                                    ساري
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
