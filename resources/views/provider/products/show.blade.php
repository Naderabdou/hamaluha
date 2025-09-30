@extends('provider.layouts.app')
@section('title', __('Home'))
{{-- @title($settings->{'site_name_' . app()->getLocale()})
@description($settings->{'about_desc_' . app()->getLocale()})
@image(asset('storage/' . $settings->logo)) --}}
@section('content')
    <div class="app-data">
        <section class="most-requested project-details m-section">
            <div class="project-details-header">
                <h2 class="sub-header">تفاصيل المنتج</h2>

                <a href=""> تعديل</a>
            </div>

            <div class="prject-details-img-slider">
                <!-- Main Slide -->
                <div class="slider-for">
                    @forelse ($product->images as $image)
                        <div><img src="{{ $image->image_path }}" alt=""></div>
                    @empty
                        <div>{{ __('لا يوجد صور') }}</div>
                    @endforelse
                </div>

                <!-- Thumbnail Nav -->
                <div class="slider-nav">
                    @forelse ($product->images as $image)
                        <div><img src="{{ $image->image_path }}" alt=""></div>
                    @empty
                        <div>{{ __('لا يوجد صور') }}</div>
                    @endforelse
                </div>

            </div>

            <div class="progect-details-description">
                <div class="description-header">
                    <div class="description-row">
                        <p>{{ $product->name }}</p>
                        <span>{{ $product->category->name }}</span>
                    </div>
                    <div class="description-row">
                        <p>
                            {{ $product->price }}
                            <img src="{{ asset('site') }}/images/ryal.svg" alt="" />
                        </p>
                    </div>
                </div>
                <div class="description-info">
                    <div class="info-row">
                        <p>تاريخ الاضافة</p>
                        <span>{{ $product->created_at->format('j/n/Y') }}</span>
                    </div>
                    <div class="info-row">
                        <p>عدد مرات التحميل</p>
                        <span> {{ $product->orders_number }} </span>
                    </div>
                    <div class="info-row status">
                        <p>اجمالى المبيعات</p>
                        <span>
                            {{ $product->total_sales }}
                            <img src="{{ asset('site') }}/images/ryal.svg" alt="" />
                        </span>
                    </div>
                    <div class="info-row">
                        <p>التقيمات</p>
                        <span>
                            {{ $product->average_rating }}
                            <i class="bi bi-star-fill"></i>
                        </span>
                    </div>
                    <div class="info-row discount">
                        <p>نسبة الخصم</p>
                        <span> 20% </span>
                    </div>
                </div>
                <div class="description-title">
                    <h3>الوصف</h3>
                    <p>
                        {{ $product->desc }}
                    </p>
                </div>
            </div>
        </section>

        <!-- comman-questions -->
        <section class="comman-questions m-section admin-accordion">
            <div class="main-container">
                <div class="comman-header sec-header">
                    <h2 class="sub-title">الاسئلة الشائعة</h2>
                    <p class="sub-paragraph">
                        هنا هتلاقي إجابات على أكثر الأسئلة الشائعة بخصوص الشراء أو
                        البيع على منصتنا. لو لسه محتاج مساعدة إضافية، فريق الدعم
                        جاهز يرد عليك في أي وقت
                    </p>
                </div>

                <div class="accordion" id="accordionExample">
                    <!-- عنصر موجود -->
                    <div class="accordion-item mb-3 position-relative">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                إزاي أحصل على المنتج بعد الدفع؟
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <div class="main-container">
                                    <p>
                                        بمجرد إتمام عملية الشراء والدفع بنجاح، هيظهرلك رابط مباشر لتحميل
                                        المنتج على صفحة التأكيد. كمان هيوصلك إيميل فيه رابط التحميل تقدر
                                        ترجعله في أي وقت.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button type="button"
                            class="btn btn-link text-danger delete-btn position-absolute top-50  translate-middle-y"
                            style="font-size: 1.4rem;">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>

                <!-- زرار الإضافة -->
                <div class="text-center mt-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAccordionModal">
                        <i class="fa-solid fa-plus"></i> إضافة
                    </button>
                </div>



            </div>
        </section>

        <!-- comments -->
        <section class="last-comments m-section">
            <div class="requested-header">
                <h2 class="sub-header"> التعليقات</h2>
            </div>
            <div class="row">
                @forelse ($product->reviews as $review)
                    <div class="col-lg-6 col-md-12">
                        <div class="comment-card">
                            <div class="comment-card-header">

                                <div class="img-container">

                                    <img src="{{ asset('site') }}/images/requested.png" alt="" />
                                </div>
                                <div class="comment-writer">
                                    <div class="writer-info">
                                        <img src="{{$review->user->avatar}}" alt="">
                                        <p>
                                            {{$review->user->name}}
                                        </p>
                                    </div>
                                    <p>
                                        {{$review->comment}}
                                    </p>
                                </div>
                                <div class="date">
                                    <p>
                                        {{$review->created_at_human}}
                                    </p>
                                </div>
                            </div>
                            <div class="comment-body">
                                <div class="img-container">
                                    <img src="{{ asset('site') }}/images/stores2.png" alt="">
                                </div>
                                <div class="comment-input">
                                    <input type="text">
                                    <button type="submit"><img src="{{ asset('site') }}/images/send.svg" alt=""></button>
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
