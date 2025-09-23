@extends('site.layouts.app')
@section('title', __('About'))

@section('header-class','pages')
@section('content')
    <!-- end header -->
    <section class="about page">
        <div class="main-container">
            <div class="row">
                <!--  -->
                <div class="col-lg-7 col-md-12">
                    <div class="about-text">
                        <div class="text-header">
                            <h2 class="sub-title">عن حمّلها</h2>
                            <p>{{ $settings->{'about_header_' . app()->getLocale()} }}</p>
                        </div>
                        <div class="text-body">
                            <p>
                                {{ $settings->{'about_desc_' . app()->getLocale()} }}
                            </p>
                            <div class="statistices">
                                <div class="stats">
                                    <div class="stat">
                                        <h2>
                                            <span class="counter" data-target="1000">0</span>+
                                        </h2>
                                        <p>عملية شراء</p>
                                    </div>
                                    <div class="stat">
                                        <h2>
                                            <span class="counter" data-target="20">0</span>+
                                        </h2>
                                        <p>متجر</p>
                                    </div>
                                    <div class="stat">
                                        <h2>
                                            <span class="counter" data-target="5000">0</span>+
                                        </h2>
                                        <p>منتج رقمي</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="col-lg-5 col-md-12">
                    <div class="about-img">
                        <img src="{{ asset('site/images/about-img.png') }}" alt="" />
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
    </section>
    <!-- end about -->

    <!-- our goals -->
    <section class="our-goals">
        <div class="main-container">
            <h2 class="sub-title">
                اهدافنا
            </h2>

            <div class="our-goals-body">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-12">
                        <ul>
                            @foreach ($goals as $goal)
                                <li>
                                    <img src="{{ asset('site/images/righ-sign.svg') }}" alt="">

                                    <p>{{ $goal->{'goal_' . app()->getLocale()} }}</p>

                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <img src="{{ asset('site/images/our-golas.png') }}" alt="">
                    </div>

                </div>
            </div>

            <div class="our-future">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="our-future-card">
                            <div class="bg">
                                <img src="{{ asset('site/images/future.svg') }}" alt="">
                            </div>
                            <div class="our-future-card-img">
                                <img src="{{ asset('site/images/eye.svg') }}" alt="">
                            </div>
                            <h4>
                                رؤيتنا
                            </h4>
                            <p>
                                {{ $settings->{'vision_' . app()->getLocale()} }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="our-future-card">

                            <div class="our-future-card-img">
                                <img src="{{ asset('site/images/message.svg') }}" alt="">
                            </div>
                            <h4>
                                رسالتنا
                            </h4>
                            <p>
                                {{ $settings->{'message_' . app()->getLocale()} }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
