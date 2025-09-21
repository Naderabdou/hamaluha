@extends('site.user.layouts.app')

@section(section: 'content')
<section class="our-stores">
            <div class="main-container">
                <h2 class="sub-title">المتاجر</h2>
                <p class="sub-paragraph">
                    اكتشف جميع المتاجر الرقمية في منصتنا وتعرف على صنّاع المحتوى المتنوعين. تصفح منتجاتهم بسهولة واختر ما يناسب احتياجاتك.
                </p>
                <div class="search-product">
                            <img src="{{asset('site/user')}}/images/search-icon.svg" alt="">
                            <input type="search"  placeholder="ابحث فالمتجر">
                </div>
                <div class="stores-cards">
                    <div class="row">
                        <div class="col-lg-3 col-md4 col-sm-6 col-12">
                            <a href="./store.html" class="store-card">
                                <div class="rate">
                                    <p>
                                        4.5
                                    </p>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <div class="card-img">
                                    <img src="{{asset('site/user')}}/images/stores1.png" alt="">
                                </div>
                                <h3>
                                    متجر Templify
                                </h3>
                                <div  class="main_btn"  data-bs-toggle="modal" data-bs-target="#chat" onclick="event.preventDefault(); event.stopPropagation();">
                                    مراسلة
                                </div>
                                <p>
                                    متجر متخصص في بيع موكابس احترافية تساعد المصممين والعلامات التجارية...
                                </p>
                            </a>
                        </div>
                        <!--  -->
                         <div class="col-lg-3 col-md4 col-sm-6 col-12">
                            <a href="./store.html"  class="store-card">
                                <div class="rate">
                                    <p>
                                        4.5
                                    </p>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <div class="card-img">
                                    <img src="{{asset('site/user')}}/images/stores2.png" alt="">
                                </div>
                                <h3>
                                    متجر Templify
                                </h3>
                                <div  class="main_btn"  data-bs-toggle="modal" data-bs-target="#chat" onclick="event.preventDefault(); event.stopPropagation();">
                                    مراسلة
                                </div>
                                <p>
                                    متجر متخصص في بيع موكابس احترافية تساعد المصممين والعلامات التجارية...
                                </p>
                            </a>
                        </div>
                        <!--  -->
                         <div class="col-lg-3 col-md4 col-sm-6 col-12">
                            <a href="./store.html" class="store-card">
                                <div class="rate">
                                    <p>
                                        4.5
                                    </p>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <div class="card-img">
                                    <img src="{{asset('site/user')}}/images/stores3.png" alt="">
                                </div>
                                <h3>
                                    متجر Templify
                                </h3>
                                <div  class="main_btn"  data-bs-toggle="modal" data-bs-target="#chat" onclick="event.preventDefault(); event.stopPropagation();">
                                    مراسلة
                                </div>
                                <p>
                                    متجر متخصص في بيع موكابس احترافية تساعد المصممين والعلامات التجارية...
                                </p>
                            </a>
                        </div>
                        <!--  -->
                         <div class="col-lg-3 col-md4 col-sm-6 col-12">
                            <a href="./store.html" class="store-card">
                                <div class="rate">
                                    <p>
                                        4.5
                                    </p>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <div class="card-img">
                                    <img src="{{asset('site/user')}}/images/stores4.png" alt="">
                                </div>
                                <h3>
                                    متجر Templify
                                </h3>
                                <div  class="main_btn"  data-bs-toggle="modal" data-bs-target="#chat" onclick="event.preventDefault(); event.stopPropagation();">
                                    مراسلة
                                </div>
                                <p>
                                    متجر متخصص في بيع موكابس احترافية تساعد المصممين والعلامات التجارية...
                                </p>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
@endsection
