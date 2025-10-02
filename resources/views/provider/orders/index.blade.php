@extends('provider.layouts.app')
@section('title', __('Orders'))
@section('content')
    <div class="app-data">

        {{-- ✅ أحدث الطلبات --}}
        <section class="most-requested m-section">
            <div class="requested-header">
                <h2 class="sub-header">احدث الطلبات</h2>
            </div>
            <div class="row">
                @foreach ($latestOrders as $order)
                    <div class="col-lg-4 col-md-6 col-21">
                        <div class="order-container">
                            <div class="order-card-items">

                                <div class="card-item">
                                    <div class="item">
                                        <p>اسم المستخدم</p>
                                        <span>{{ $order->name }}</span>
                                    </div>
                                    <div class="item">
                                        <p>تاريخ الطلب</p>
                                        <span>{{ $order->created_at->translatedFormat('اليوم g:i A') }}</span>
                                    </div>
                                </div>

                                <div class="card-item">
                                    <div class="item">
                                        <p>عدد المنتجات</p>
                                        <span>{{ $order->orderItems->count() }}</span>
                                    </div>
                                    <div class="item">
                                        <p>اجمالي السعر</p>
                                        <span>
                                            {{ $order->total }}
                                            <img src="{{ asset('site/images/ryal.svg') }}" alt="">
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="card-link">
                                <a href="{{ route('site.provider.orders.show', $order->id) }}" class="main_btn">
                                    عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ✅ كل الطلبات --}}
        <section class="most-requested m-section">
            <div class="requested-header">
                <h2 class="sub-header">كل الطلبات</h2>

                <div class="filter-product">
                    <a href="javascript:void(0)" class="main_btn" id="toggleFilter">
                        تصفية
                    </a>

                    <form method="GET" action="{{ route('site.provider.orders.index') }}">
                        <div class="filters" id="filtersBox">
                            <div class="filter-section">
                                <h4>التاريخ</h4>

                                <label>
                                    <input type="radio" name="date_filter" value="all"
                                        {{ request('date_filter') == 'all' ? 'checked' : '' }}>
                                    <span>الكل</span>
                                </label>

                                <label>
                                    <input type="radio" name="date_filter" value="today"
                                        {{ request('date_filter') == 'today' ? 'checked' : '' }}>
                                    <span>اليوم</span>
                                </label>

                                <label>
                                    <input type="radio" name="date_filter" value="week"
                                        {{ request('date_filter') == 'week' ? 'checked' : '' }}>
                                    <span>هذا الأسبوع</span>
                                </label>

                                <label>
                                    <input type="radio" name="date_filter" value="month"
                                        {{ request('date_filter') == 'month' ? 'checked' : '' }}>
                                    <span>هذا الشهر</span>
                                </label>
                            </div>

                            <button type="submit" class="main_btn">تطبيق</button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="row">
                @foreach ($orders as $order)
                    <div class="col-lg-4 col-md-6 col-21">
                        <div class="order-container">
                            <div class="order-card-items">

                                <div class="card-item">
                                    <div class="item">
                                        <p>اسم المستخدم</p>
                                        <span>{{ $order->name }}</span>
                                    </div>
                                    <div class="item">
                                        <p>تاريخ الطلب</p>
                                        <span>{{ $order->created_at->translatedFormat('اليوم g:i A') }}</span>
                                    </div>
                                </div>

                                <div class="card-item">
                                    <div class="item">
                                        <p>عدد المنتجات</p>
                                        <span>{{ $order->orderItems->count() }}</span>
                                    </div>
                                    <div class="item">
                                        <p>اجمالي السعر</p>
                                        <span>
                                            {{ $order->total }}
                                            <img src="{{ asset('site/images/ryal.svg') }}" alt="">
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="card-link">
                                <a href="{{ route('site.provider.orders.show', $order->id) }}" class="main_btn">
                                    عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div>
                {{ $orders->links() }}
            </div>
        </section>

    </div>
@endsection
