@extends('site.layouts.app')
@section('title', __('عربة التسوق'))

@section('header-class', 'pages')
@section('content')

    <!-- out products -->
    <section class="our-cart">
        <div class="main-container">
            <h2 class="sub-title"> {{ __('سلة الشراء') }}</h2>
            <p class="sub-paragraph">
                {{ __(' استعرض منتجاتك المختارة في مكان واحد، عدّل الكمية أو احذف ما لا تحتاجه، ثم تابع لإتمام عملية الدفع بسهولة وأمان.') }}

            </p>

            <div class="cart-details">
                <div class="row">
                    <div class="col-lg-8 col-md-12">

                        @if (count($cart) > 0)
                            @foreach ($cart as $productId => $item)
                                <div class="order-card mb-3">
                                    <div class="order-img">
                                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                                    </div>
                                    <div class="order-body">
                                        <div class="order-text">
                                            <div class="order-text-header d-flex justify-content-between">
                                                <h2>{{ $item['name'] }}</h2>
                                                <a href="{{ route('site.cart.remove', $productId) }}" class="trash">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5 21V6H4V4H9V3H15V4H20V6H19V21H5ZM7 19H17V6H7V19ZM9 17H11V8H9V17ZM13 17H15V8H13V17Z"
                                                            fill="#24A19C" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <p>عدد القطع: {{ $item['quantity'] }}</p>
                                        </div>
                                        <div class="order-end d-flex justify-content-between">
                                            <span>المتجر:{{ $item['store_name'] }}
                                            </span>
                                            <div class="price">
                                                <p>{{ $item['price'] * $item['quantity'] }}</p>
                                                <img src="{{ asset('site/images/ryal.svg') }}" alt="ريال" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>السلة فارغة حالياً.</p>
                        @endif

                    </div>

                    <!--  -->
                    <div class="col-lg-4 col-md-12">
                        <div class="payment-box">
                            <h4>اختر طريقة الدفع المناسبة</h4>

                            <form action="{{ route('site.cart.checkout') }}" method="POST">
                                @csrf

                                <label class="payment-option">
                                    <input type="radio" name="payment" value="paypal" checked>
                                    <img src="{{ asset('site/images/payment.svg') }}" alt="PayPal">
                                </label>

                                <label class="payment-option">
                                    <input type="radio" name="payment" value="mastercard">
                                    <img src="{{ asset('site/images/payment1.svg') }}" alt="MasterCard">
                                </label>

                                <label class="payment-option">
                                    <input type="radio" name="payment" value="applepay">
                                    <img src="{{ asset('site/images/payment2.svg') }}" alt="Apple Pay">
                                </label>

                                <div class="total mt-3">
                                    <span>السعر الكلي :</span>
                                    <strong>
                                        {{ $total }}
                                        <img src="{{ asset('site/images/ryal.svg') }}" alt="">
                                    </strong>
                                </div>

                                <div class="payment-actions">
                                    <button class="main_btn">استكمل الدفع</button>
                                    <a href="#" class="guest-pay">الدفع كزائر</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </section>


@endsection
