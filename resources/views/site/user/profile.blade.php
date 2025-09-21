@extends('site.user.layouts.app')

@section(section: 'content')
<div class="profile m-section">

          <div class="profile-info">
            <div class="avatar">
              <img src="{{asset('site/user')}}/images/avatar.svg" alt="">
            </div>
            <h3>
                محمد احمد
            </h3>
            <p>
              matjer54@gmail.com
            </p>
            <a href="" data-bs-toggle="modal" data-bs-target="#changeInfo">
              تعديل البيانات
            </a>
          </div>
          <section class="comman-questions description m-section">
            <div class="main-container">
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="accordion">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#collapseOne"
                          aria-expanded="true"
                          aria-controls="collapseOne"
                        >
                          <div class="profile-item-img">
                            <img src="{{asset('site/user')}}/images/cart-nav.svg" alt="" />
                          </div>
                          الطلبات
                        </button>
                      </h2>
                      <div
                        id="collapseOne"
                        class="accordion-collapse collapse show"
                      >
                        <div class="accordion-body">
                          <div class="row">
                            <div class="col-lg-6 col-md-12">

                              <!--  -->
                              <div class="order-card">
                                <div class="order-img">
                                  <img src="{{asset('site/user')}}/images//ORDER.png" alt="" />
                                </div>
                                <div class="order-body">

                                  <div class="order-text">
                                    <div class="order-text-header">
                                      <h2>دليل المبتدئين في التصميم الجرافيكي</h2>
                                      <a href="" class="download">
                                        <img
                                          src="{{asset('site/user')}}/images/quill_download.svg"
                                          alt=""
                                        />
                                        <span>تحميل</span>
                                      </a>
                                    </div>
                                    <p>متجر Templify</p>
                                  </div>
                                  <div class="order-end">
                                    <span> قوالب تصميم </span>
                                    <div class="price">
                                      <p>150</p>
                                      <img src="{{asset('site/user')}}/images/ryal.svg" alt="" />
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <!--  -->
                            </div>
                            <div class="col-lg-6 col-md-12">
                              <!--  -->

                              <div class="order-card">
                                <div class="order-img">
                                  <img src="{{asset('site/user')}}/images//ORDER.png" alt="" />
                                </div>
                                <div class="order-body">

                                  <div class="order-text">
                                    <div class="order-text-header">
                                      <h2>دليل المبتدئين في التصميم الجرافيكي</h2>
                                      <a href="" class="download">
                                        <img
                                          src="{{asset('site/user')}}/images/quill_download.svg"
                                          alt=""
                                        />
                                        <span>تحميل</span>
                                      </a>
                                    </div>
                                    <p>متجر Templify</p>
                                  </div>
                                  <div class="order-end">
                                    <span> قوالب تصميم </span>
                                    <div class="price">
                                      <p>150</p>
                                      <img src="{{asset('site/user')}}/images/ryal.svg" alt="" />
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!--  -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--  -->
                  </div>
                </div>
              </div>

              <!--  -->
              <div class="profile-actions">
                  <a href="" data-bs-toggle="modal" data-bs-target="#changePassword">

                    <div class="profile-item-img">
                        <img src="{{asset('site/user')}}/images/mdi_password.svg" alt="" />
                      </div>
                      تغيير كلمة المرور
                  </a>
                  <!--  -->
                  <a href="" data-bs-toggle="modal" data-bs-target="#deleteUser">

                    <div class="profile-item-img">
                        <img src="{{asset('site/user')}}/images/trash.svg" alt="" />
                      </div>
                      حذف الحساب
                  </a>

                  <!--  -->
                  <a href="" data-bs-toggle="modal" data-bs-target="#logout">

                    <div class="profile-item-img">
                        <img src="{{asset('site/user')}}/images/logout.svg" alt="" />
                      </div>
                       تسجيل الخروج
                  </a>
              </div>
              <!--  -->
            </div>
          </section>


</div>


 <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">

              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <section class="auth login modal-profile">

                  <form action="">
                    <h1>تغيير كلمة المرور</h1>




                    <div class="form-control-container">


                      <input type="password" id="inputPassword5" placeholder=" كلمة المرور الجديدة" class="form-control" aria-describedby="passwordHelpBlock">
                    </div>
                    <div class="form-control-container">


                      <input type="password" id="inputPassword5" placeholder="  تأكيد كلمة المرور الجديدة"   class="form-control" aria-describedby="passwordHelpBlock">
                    </div>


                    <button type="submit" class="main_btn">
                      التالى
                    </button>

                  </form>
                </section>

              </div>

            </div>
          </div>
        </div>


        <!-- deleteUser -->


        <div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">

              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <section class="auth login modal-profile">

                  <form action="">


                     <h1>  حذف الحساب</h1>




                    <p>
                      هل انت متأكد من انك تريد حذف الحساب
                    </p>
                    <button type="submit" class="main_btn">
                      نعم
                    </button>

                  </form>
                </section>

              </div>

            </div>
          </div>
        </div>

        <!-- logout  -->



        <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">

              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <section class="auth login modal-profile">

                  <form action="">


                     <h1> تسجيل الخروج</h1>




                    <p>
                      هل انت متأكد من انك تريد تسجيل الخروج؟
                    </p>

                    <button type="submit" class="main_btn">
                      نعم
                    </button>

                  </form>
                </section>

              </div>

            </div>
          </div>
        </div>



        <!-- changeInfo -->


        <div class="modal fade" id="changeInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">

              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <section class="auth login modal-profile">

                  <form action="">


                     <h1> تعديل البيانات </h1>

                     <div class="form-control-container">


                      <input type="text" id="inputPassword5" placeholder=" الاسم " value="محمد احمد
" class="form-control" aria-describedby="passwordHelpBlock">
                    </div>

                    <div class="form-control-container">


                      <input type="text" id="inputPassword5" value="matjer54@gmail.com

" placeholder=" البريد الالكتروني" class="form-control" aria-describedby="passwordHelpBlock">
                    </div>



                    <button type="submit" class="main_btn">
                      تعديل
                    </button>

                  </form>
                </section>

              </div>

            </div>
          </div>
        </div>
@endsection

