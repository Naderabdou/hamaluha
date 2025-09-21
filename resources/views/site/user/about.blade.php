@extends('site.user.layouts.app')

@section(section: 'content')
     <!-- end header -->
        <section class="about page">
          <div class="main-container">
            <div class="row">
              <!--  -->
              <div class="col-lg-7 col-md-12">
                <div class="about-text">
                  <div class="text-header">
                    <h2 class="sub-title">عن حمّلها</h2>
                    <p>حول شغفك إلى دخل</p>
                  </div>
                  <div class="text-body">
                    <p>
                      منصة مبتكرة لبيع وشراء المنتجات الرقمية، تربط بين البائعين
                      المبدعين والمشترين الباحثين عن محتوى ممي نوفر لك بيئة آمنة
                      وسهلة الاستخدام، سواء كنت بائعًا تسعى لنشر إبداعك أو
                      مشتريًا تبحث عن أدوات تسهّل عملك وتطورك.
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
                  <img src="{{asset('site/user')}}/images/about-img.png" alt="" />
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
                                <li>
                                    <img src="{{asset('site/user')}}/images/righ-sign.svg" alt="">
                                    <p>
                                        تمكين صناع المحتوى الرقمي من تحقيق دخل مستدام من أعمالهم
                                    </p>
                                </li>
                                <li>
                                    <img src="{{asset('site/user')}}/images/righ-sign.svg" alt="">
                                    <p>
                                        بناء مجتمع رقمي عربي يزدهر بالمحتوى الإبداعي
                                    </p>
                                </li>
                                <li>
                                    <img src="{{asset('site/user')}}/images/righ-sign.svg" alt="">
                                    <p>
                                       توفير منصة احترافية منافسة للمنصات العالمية
                                    </p>
                                </li>
                                <li>
                                    <img src="{{asset('site/user')}}/images/righ-sign.svg" alt="">
                                    <p>
                                        دعم التحول نحو الاقتصاد الرقمي في العالم العربي
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <img src="{{asset('site/user')}}/images/our-golas.png" alt="">
                        </div>
                    </div>
                </div>

                <div class="our-future">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="our-future-card">
                                 <div class="bg">
                                    <img src="{{asset('site/user')}}/images/future.svg" alt="">
                                </div>
                                <div class="our-future-card-img">
                                    <img src="{{asset('site/user')}}/images/eye.svg" alt="">
                                </div>
                                <h4>
                                    رؤيتنا
                                </h4>
                                <p>
                                     أن نكون المنصة العربية الأولى لبيع وتحميل المنتجات الرقمية بسهولة وأمان
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="our-future-card">

                                <div class="our-future-card-img">
                                    <img src="{{asset('site/user')}}/images/message.svg" alt="">
                                </div>
                                <h4>
                                    رسالتنا
                                </h4>
                                <p>
                                     نربط صُنّاع المحتوى بالمستخدمين عبر تجربة شراء سلسة وموثوقة.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

