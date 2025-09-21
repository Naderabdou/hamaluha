@extends('site.user.layouts.app')

@section(section: 'content')
<section class="project-details m-section">
        <div class="main-container">
            <div class="project-details-header">
                <div class="header-row">
                    <h2>
                        Coffee mug mockup
                    </h2>
                    <a href="">
                        متجر Templify
                    </a>
                </div>
                <div class="header-row">
                    <a href="" class="main_btn">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.3346 10.9997C11.6883 10.9997 12.0274 11.1402 12.2774 11.3902C12.5275 11.6402 12.668 11.9794 12.668 12.333C12.668 12.6866 12.5275 13.0258 12.2774 13.2758C12.0274 13.5259 11.6883 13.6663 11.3346 13.6663C10.981 13.6663 10.6419 13.5259 10.3918 13.2758C10.1418 13.0258 10.0013 12.6866 10.0013 12.333C10.0013 11.593 10.5946 10.9997 11.3346 10.9997ZM0.667969 0.333008H2.84797L3.47464 1.66634H13.3346C13.5114 1.66634 13.681 1.73658 13.806 1.8616C13.9311 1.98663 14.0013 2.1562 14.0013 2.33301C14.0013 2.44634 13.968 2.55967 13.9213 2.66634L11.5346 6.97967C11.308 7.38634 10.868 7.66634 10.368 7.66634H5.4013L4.8013 8.75301L4.7813 8.83301C4.7813 8.87721 4.79886 8.9196 4.83012 8.95086C4.86137 8.98212 4.90377 8.99967 4.94797 8.99967H12.668V10.333H4.66797C4.31435 10.333 3.97521 10.1925 3.72516 9.94248C3.47511 9.69244 3.33464 9.3533 3.33464 8.99967C3.33464 8.76634 3.39464 8.54634 3.49464 8.35967L4.4013 6.72634L2.0013 1.66634H0.667969V0.333008ZM4.66797 10.9997C5.02159 10.9997 5.36073 11.1402 5.61078 11.3902C5.86083 11.6402 6.0013 11.9794 6.0013 12.333C6.0013 12.6866 5.86083 13.0258 5.61078 13.2758C5.36073 13.5259 5.02159 13.6663 4.66797 13.6663C4.31435 13.6663 3.97521 13.5259 3.72516 13.2758C3.47511 13.0258 3.33464 12.6866 3.33464 12.333C3.33464 11.593 3.92797 10.9997 4.66797 10.9997ZM10.668 6.33301L12.5213 2.99967H4.09464L5.66797 6.33301H10.668Z" fill="white"/>
                        </svg>

                        <span>
                            اضف المنتج الى السلة
                        </span>
                    </a>
                    <div class="price">
                        <p>150</p>
                        <img src="{{asset('site/user')}}/images/ryal.svg" alt="">
                    </div>
                </div>
            </div>

            <div class="prject-details-img-slider">
                <!-- Main Slide -->
                <div class="slider-for">
                    <div><img src="{{asset('site/user')}}/images/product.png" alt=""></div>
                    <div><img src="{{asset('site/user')}}/images/product.png" alt=""></div>
                    <div><img src="{{asset('site/user')}}/images/product.png" alt=""></div>
                    <div><img src="{{asset('site/user')}}/images/product.png" alt=""></div>
                </div>

                <!-- Thumbnail Nav -->
                <div class="slider-nav">
                    <div><img src="{{asset('site/user')}}/images/product.png" alt=""></div>
                    <div><img src="{{asset('site/user')}}/images/product.png" alt=""></div>
                    <div><img src="{{asset('site/user')}}/images/product.png" alt=""></div>
                    <div><img src="{{asset('site/user')}}/images/product.png" alt=""></div>
                </div>

            </div>

            <div class="progect-details-description">
                <!-- comman-questions -->
                <section class="comman-questions description m-section">


                        <div class="row">
                            <div class="col-lg-12 col-md-12">


                                <div class="accordion">
                                        <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            الوصف
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" >
                                            <div class="accordion-body">
                                                <div class="main-container">

                                                        <p>
                                                            كتاب عملي يقدّم أساسيات ومفاهيم تصميم الجرافيك بشكل مبسّط تعلّم أساسيات التصميم بخطوات سهلة.كتاب عملي يقدّم أساسيات ومفاهيم تصميم الجرافيك بشكل مبسّط تعلّم أساسيات التصميم بخطوات سهلة...كتاب عملي يقدّم أساسيات ومفاهيم تصميم الجرافيك بشكل مبسّط تعلّم أساسيات التصميم بخطوات سهلة...كتاب عملي يقدّم عرض المزيد..
                                                        </p>



                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <!--  -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button  collapsed" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#collapseTwo" aria-controls="collapseTwo">
                                                أراء العملاء
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse " >
                                                <div class="accordion-body">
                                                    <div class="main-container">

                                                        <div class="clients-comment">
                                                            <div class="comment-card">
                                                                <div class="card-header">
                                                                    <div class="card-img">
                                                                        <img src="{{asset('site/user')}}/images/client-img.png" alt="">
                                                                        <p>عبد العزيز ال سعود</p>
                                                                    </div>
                                                                    <div class="date">
                                                                        <p>
                                                                            30 يناير 2025
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <p>
                                                                    الكتاب بسيط وسهل الفهم، شرح الخطوات مدعوم بالصور والتطبيقات العملية. ساعدني أطور مهاراتي في التصميم وأطبقها على شغلي بسرعة. أنصح أي مبتدئ في مجال الجرافيك إنه يبدأ بالكتاب ده.
                                                                </p>

                                                            </div>
                                                            <div class="comment-card">
                                                                <div class="card-header">
                                                                    <div class="card-img">
                                                                        <img src="{{asset('site/user')}}/images/client-img.png" alt="">
                                                                        <p>عبد العزيز ال سعود</p>
                                                                    </div>
                                                                    <div class="date">
                                                                        <p>
                                                                            30 يناير 2025
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <p>
                                                                    الكتاب بسيط وسهل الفهم، شرح الخطوات مدعوم بالصور والتطبيقات العملية. ساعدني أطور مهاراتي في التصميم وأطبقها على شغلي بسرعة. أنصح أي مبتدئ في مجال الجرافيك إنه يبدأ بالكتاب ده.
                                                                </p>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->

                                </div>



                                <div class="add-comment">
                                  <form action="">

                                    <p>
                                      اضف تعليق
                                    </p>


                                    <div class="stars">
                                      <input type="radio" id="star5" name="rating" value="5" />
                                      <label for="star5">
                                        <i class="bi bi-star-fill"></i>
                                      </label>

                                      <input type="radio" id="star4" name="rating" value="4" />
                                      <label for="star4">
                                        <i class="bi bi-star-fill"></i>
                                      </label>

                                      <input type="radio" id="star3" name="rating" value="3" />
                                      <label for="star3">
                                        <i class="bi bi-star-fill"></i>
                                      </label>

                                      <input type="radio" id="star2" name="rating" value="2" />
                                      <label for="star2">
                                        <i class="bi bi-star-fill"></i>
                                      </label>

                                      <input type="radio" id="star1" name="rating" value="1" />
                                      <label for="star1">
                                        <i class="bi bi-star-fill"></i>
                                      </label>
                                    </div>
                                    <textarea name="" id="" placeholder="نص التعليق"></textarea>


                                  </form>
                                </div>

                            </div>

                        </div>

                </section>



            </div>
            <!-- other products -->
            <section class="other-products">
                    <form action="">
                        <h2>
                            منتجات أخرى اشتراها العملاء
                        </h2>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="best-seller-card details">
                                    <div class="card-img">
                                       <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                    <img src="{{asset('site/user')}}/images/best-seller1.png" alt="" />
                                    </div>
                                    <div class="card-body">

                                    <div class="top-price">
                                      <span>  متجر Templify</span>
                                      <div class="price">
                                        50
                                        <img src="{{asset('site/user')}}/images/ryal.svg" alt="" />
                                    </div>
                                    </div>

                                    <h3>دليل المبتدئين فى تصميم الوايرفريم</h3>
                                    <p>
                                        كتاب عملي يقدّم أساسيات ومفاهيم تصميم الجرافيك بشكل
                                        مبسّط تعلّم أساسيات التصميم بخطوات سهلة...
                                    </p>
                                    </div>
                                    <div class="card-footer">


                                    </div>
                                </div>
                            </div>
                            <!--  -->
                             <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="best-seller-card details">
                                    <div class="card-img">
                                      <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                    <img src="{{asset('site/user')}}/images/best-seller1.png" alt="" />
                                    </div>
                                    <div class="card-body">
                                    <div class="top-price">
                                      <span>  متجر Templify</span>
                                      <div class="price">
                                        50
                                        <img src="{{asset('site/user')}}/images/ryal.svg" alt="" />
                                    </div>
                                    </div>

                                    <h3>دليل المبتدئين فى تصميم الوايرفريم</h3>
                                    <p>
                                        كتاب عملي يقدّم أساسيات ومفاهيم تصميم الجرافيك بشكل
                                        مبسّط تعلّم أساسيات التصميم بخطوات سهلة...
                                    </p>
                                    </div>
                                    <div class="card-footer">


                                    </div>
                                </div>
                            </div>
                            <!--  -->
                              <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="best-seller-card details">
                                    <div class="card-img">
                                      <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                    <img src="{{asset('site/user')}}/images/best-seller1.png" alt="" />
                                    </div>
                                    <div class="card-body">
                                    <div class="top-price">
                                      <span>  متجر Templify</span>
                                      <div class="price">
                                        50
                                        <img src="{{asset('site/user')}}/images/ryal.svg" alt="" />
                                    </div>
                                    </div>

                                    <h3>دليل المبتدئين فى تصميم الوايرفريم</h3>
                                    <p>
                                        كتاب عملي يقدّم أساسيات ومفاهيم تصميم الجرافيك بشكل
                                        مبسّط تعلّم أساسيات التصميم بخطوات سهلة...
                                    </p>
                                    </div>
                                    <div class="card-footer">


                                    </div>
                                </div>
                            </div>
                            <!--  -->
                             <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="best-seller-card details">
                                  <div class="card-img">
                                      <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                    <img src="{{asset('site/user')}}/images/best-seller1.png" alt="" />
                                    </div>
                                    <div class="card-body">
                                    <div class="top-price">
                                      <span>  متجر Templify</span>
                                      <div class="price">
                                        50
                                        <img src="{{asset('site/user')}}/images/ryal.svg" alt="" />
                                    </div>
                                    </div>

                                    <h3>دليل المبتدئين فى تصميم الوايرفريم</h3>
                                    <p>
                                        كتاب عملي يقدّم أساسيات ومفاهيم تصميم الجرافيك بشكل
                                        مبسّط تعلّم أساسيات التصميم بخطوات سهلة...
                                    </p>
                                    </div>
                                    <div class="card-footer">


                                    </div>
                                </div>
                            </div>
                            <!--  -->
                        </div>

                        <div class="other-total">
                          <button type="submit"  class="main_btn">
                              <svg
                              width="14"
                              height="14"
                              viewBox="0 0 14 14"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                              >
                              <path
                                  d="M11.3346 10.9997C11.6883 10.9997 12.0274 11.1402 12.2774 11.3902C12.5275 11.6402 12.668 11.9794 12.668 12.333C12.668 12.6866 12.5275 13.0258 12.2774 13.2758C12.0274 13.5259 11.6883 13.6663 11.3346 13.6663C10.981 13.6663 10.6419 13.5259 10.3918 13.2758C10.1418 13.0258 10.0013 12.6866 10.0013 12.333C10.0013 11.593 10.5946 10.9997 11.3346 10.9997ZM0.667969 0.333008H2.84797L3.47464 1.66634H13.3346C13.5114 1.66634 13.681 1.73658 13.806 1.8616C13.9311 1.98663 14.0013 2.1562 14.0013 2.33301C14.0013 2.44634 13.968 2.55967 13.9213 2.66634L11.5346 6.97967C11.308 7.38634 10.868 7.66634 10.368 7.66634H5.4013L4.8013 8.75301L4.7813 8.83301C4.7813 8.87721 4.79886 8.9196 4.83012 8.95086C4.86137 8.98212 4.90377 8.99967 4.94797 8.99967H12.668V10.333H4.66797C4.31435 10.333 3.97521 10.1925 3.72516 9.94248C3.47511 9.69244 3.33464 9.3533 3.33464 8.99967C3.33464 8.76634 3.39464 8.54634 3.49464 8.35967L4.4013 6.72634L2.0013 1.66634H0.667969V0.333008ZM4.66797 10.9997C5.02159 10.9997 5.36073 11.1402 5.61078 11.3902C5.86083 11.6402 6.0013 11.9794 6.0013 12.333C6.0013 12.6866 5.86083 13.0258 5.61078 13.2758C5.36073 13.5259 5.02159 13.6663 4.66797 13.6663C4.31435 13.6663 3.97521 13.5259 3.72516 13.2758C3.47511 13.0258 3.33464 12.6866 3.33464 12.333C3.33464 11.593 3.92797 10.9997 4.66797 10.9997ZM10.668 6.33301L12.5213 2.99967H4.09464L5.66797 6.33301H10.668Z"
                                  fill="white"
                              />
                              </svg>
                                  اضف الى السلة
                            </button>
                            <div class="total-price">
                              <p>
                                السعر الكلى :
                              </p>
                              <div class="price">
                                        50
                                        <img src="{{asset('site/user')}}/images/ryal.svg" alt="" />
                              </div>
                            </div>
                        </div>



                    </form>

            </section>

        </div>

    </section>
@endsection
