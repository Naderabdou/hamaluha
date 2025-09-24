@extends('site.layouts.app')
@section('title', __('المتاجر'))

@section('header-class','pages')
@section('content')

<section class="our-stores">
    <div class="main-container">
        <h2 class="sub-title">المتاجر</h2>
        <p class="sub-paragraph">
            اكتشف جميع المتاجر الرقمية في منصتنا وتعرف على صنّاع المحتوى المتنوعين. تصفح منتجاتهم بسهولة واختر ما يناسب احتياجاتك.
        </p>

        <!-- Search -->
        <form method="GET" action="{{ route('site.stores.index') }}" class="search-product">
            <img src="{{ asset('site/images/search-icon.svg') }}" alt="">
            <input
                type="search"
                name="q"
                value="{{ $query }}"
                placeholder="ابحث في المتجر"
            >
        </form>

        <!-- Stores -->
        <div class="stores-cards">
            <div class="row">
                @forelse($stores as $store)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <a href="{{ route('site.stores.show', $store->id) }}" class="store-card">
                            <div class="rate">
                                <p>{{ number_format($store->reviews_avg_rating ?? 4.5, 1) }}</p>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="card-img">
                                <img src="{{ $store->image_path }}"
                                     alt="{{ $store->name }}">
                            </div>
                            <h3>{{ $store->name }}</h3>
                            <div class="main_btn" data-bs-toggle="modal" data-bs-target="#chat" onclick="event.preventDefault(); event.stopPropagation();">
                                مراسلة
                            </div>
                            <p>{{ Str::limit($store->desc, 100) }}</p>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">    {{ __('لا توجد متاجر متطابقة للبحث') }}</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $stores->links() }}
        </div>
    </div>
</section>

@endsection
