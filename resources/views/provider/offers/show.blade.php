@extends('provider.layouts.app')
@section('title', 'تفاصيل العرض')

@section('content')
    <div class="app-data">
        <section class="most-requested project-details m-section">
            <div class="project-details-header">
                <h2 class="sub-header">تفاصيل العرض</h2>
                {{-- <a href="{{ route('site.provider.offers.edit', $offer->id) }}">تعديل</a> --}}
            </div>

            <!-- صور العرض -->
            <div class="prject-details-img-slider">
                <div class="slider-for">
                    <div>
                        <img src="{{ $offer->image ? asset('storage/' . $offer->image) : asset('images/default.png') }}"
                            alt="offer" />
                    </div>
                </div>

                <div class="slider-nav">
                    <div>
                        <img src="{{ $offer->image ? asset('storage/' . $offer->image) : asset('images/default.png') }}"
                            alt="offer-thumb" />
                    </div>
                </div>
            </div>

            <!-- تفاصيل العرض -->
            <div class="progect-details-description">
                <div class="description-header">
                    <div class="description-row">
                        <p>{{ $offer->desc_ar ?? $offer->desc_en }}</p>
                        <span> {{ $offer->products->first()->name ?? '---' }} </span>
                    </div>
                    <div class="description-row">
                        <p>
                            <!-- السعر قبل الخصم -->
                            <span style="text-decoration: line-through; color:#888;">
                                {{ $offer->products->sum('price') }}
                            </span>
                            <img src="{{ asset('site/images/ryal.svg') }}" alt="" />

                            <!-- السعر بعد الخصم -->
                            @php
                                $totalPrice = $offer->products->sum('price');
                                if ($offer->type === 'offer') {
                                    // خصم نسبة
                                    $finalPrice = $totalPrice - $totalPrice * ($offer->discount / 100);
                                } else {
                                    // خصم مبلغ ثابت
                                    $finalPrice = max($totalPrice - $offer->discount, 0);
                                }
                            @endphp
                            <span style="margin-right: 10px; font-weight:bold; color:#000;">
                                {{ number_format($finalPrice, 2) }}
                            </span>
                            <img src="{{ asset('site/images/ryal.svg') }}" alt="" />
                        </p>
                    </div>

                </div>

                <div class="description-info">
                    <div class="info-row">
                        <p>بداية العرض</p>
                        <span>{{ \Carbon\Carbon::parse($offer->start_at)->format('d/m/Y') }}</span>
                    </div>
                    <div class="info-row">
                        <p>نهاية العرض</p>
                        <span>{{ \Carbon\Carbon::parse($offer->end_at)->format('d/m/Y') }}</span>
                    </div>
                    <div class="info-row status">
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
                    <div class="info-row discount">
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

                <div class="description-title">
                    <h3>الوصف</h3>
                    <p>
                        {{ $offer->desc_ar ?? $offer->desc_en }}
                    </p>
                </div>
            </div>
        </section>

        <!-- المنتجات المرتبطة بالعرض -->
        {{-- <section class="most-requested m-section">
        <div class="requested-header">
            <h2 class="sub-header">المنتجات المرتبطة</h2>
        </div>
        <div class="row">
            @foreach ($offer->products as $product)
                <div class="col-lg-4 col-md-6">
                    <div class="requested-card">
                        <div class="img-container">
                            <img src="{{ $product->first_image ?? asset('images/default.png') }}"
                                 alt="product">
                        </div>
                        <div class="requested-body">
                            <div class="body-item">
                                <p>{{ $product->name }}</p>
                                <span>{{ $product->price }} <img src="{{ asset('site/images/ryal.svg') }}" alt=""></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($offer->products->isEmpty())
                <p class="text-center">لا توجد منتجات مرتبطة بهذا العرض</p>
            @endif
        </div>
    </section> --}}
    </div>
@endsection
