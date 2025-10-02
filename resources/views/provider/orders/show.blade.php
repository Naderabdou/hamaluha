@extends('provider.layouts.app')
@section('title', __('Orders'))
@section('content')

    <div class="app-data">

        <!-- تفاصيل الطلب -->
        <section class="order-details m-section">
            <div class="main-container">
                <div class="progect-details-description">
                    <div class="requested-header">
                        <h2 class="sub-header">تفاصيل الطلب</h2>
                    </div>
                    <div class="description-info">
                        <div class="info-row">
                            <p>رقم الطلب</p>
                            <span>{{ $order->id }}</span>
                        </div>
                        <div class="info-row">
                            <p>اسم المستخدم</p>
                            <span>{{ $order->user->name }}</span>
                        </div>
                        <div class="info-row">
                            <p>تاريخ الطلب</p>
                            <span>{{ $order->created_at->translatedFormat('اليوم g:i A') }}</span>
                        </div>
                        <div class="info-row status">
                            <p>حالة الدفع</p>
                            <span>{{ ucfirst($order->status) }}</span>
                        </div>
                        <div class="info-row status">
                            <p>إجمالي المبيعات</p>
                            <span>
                                {{ $order->total }}
                                <img src="{{ asset('site/images/ryal.svg') }}" alt="" />
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- المنتجات المرتبطة بالطلب -->
        <section class="most-requested">
            <div class="requested-header">
                <h2 class="sub-header">المنتجات</h2>
            </div>
            <div class="row">
                @foreach ($order->orderItems as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="requested-card">

                            <div class="img-container">
                                <div class="requested-title">
                                    <p>{{ $item->product->name }}</p>
                                    <span>{{ $item->product->category->name ?? '' }}</span>
                                </div>
                                <img src="{{ $item->image_path }}" alt="{{ $item->product->name }}" />
                            </div>

                            <div class="requested-body">
                                <div class="body-item">
                                    <div class="item-container">
                                        <div class="item-card">
                                            <p>عدد مرات التحميل</p>
                                            <span>{{ $item->downloads ?? 0 }}</span>
                                        </div>

                                        <div class="item-card price">
                                            <p>سعر المنتج</p>
                                            <span>
                                                {{ $item->price }}
                                                @if ($item->discount)
                                                    <p>{{ $item->price - ($item->price * $item->discount) / 100 }}</p>
                                                @endif
                                                <img src="{{ asset('site/images/ryal.svg') }}" alt="" />
                                            </span>
                                        </div>

                                        <div class="item-card discount">
                                            <p>نسبة الخصم</p>
                                            <span>{{ $item->discount ?? 0 }}%</span>
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
