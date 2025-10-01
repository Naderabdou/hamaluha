@extends('site.layouts.app')
@section('title', __('Profile'))

@section('header-class', 'pages')
@section('content')
    <div class="profile m-section">

        <div class="profile-info">
            <div class="avatar">
                <img src="{{ asset('site') }}/images/avatar.svg" alt="">
            </div>
            <h3>
                {{ auth()->user()->name }}
            </h3>
            <p>
                {{ auth()->user()->email }}
            </p>
            <a href="" data-bs-toggle="modal" data-bs-target="#changeInfo">
                {{ __('تعديل البيانات') }}
            </a>
        </div>
        <section class="comman-questions description m-section">
            <div class="main-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="profile-item-img">
                                            <img src="{{ asset('site') }}/images/cart-nav.svg" alt="" />
                                        </div>
                                        الطلبات
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row">
                                            @forelse ($products as $product)
                                                <div class="col-lg-6 col-md-12">
                                                    <!--  -->
                                                    <div class="order-card">
                                                        <div class="order-img">
                                                            <img src="{{ $product->first_image->image_path }}"
                                                                alt="" />
                                                        </div>
                                                        <div class="order-body">

                                                            <div class="order-text">
                                                                <div class="order-text-header">
                                                                    <h2>{{ $product->name }}</h2>
                                                                    <a href="{{ route('site.products.download', $product->slug) }}"
                                                                        class="download">
                                                                        <img src="{{ asset('site') }}/images/quill_download.svg"
                                                                            alt="" />
                                                                        <span>{{ __('تحميل') }}</span>
                                                                    </a>
                                                                </div>
                                                                <p>{{ $product->store->name }}</p>
                                                            </div>
                                                            <div class="order-end">
                                                                <span> {{ $product->category->name }}</span>
                                                                <div class="price">
                                                                    <p>{{ $product->price }}</p>
                                                                    <img src="{{ asset('site') }}/images/ryal.svg"
                                                                        alt="" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div>لا يوجد مشتريات</div>
                                            @endforelse
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
                    @if (auth()->user()->type == 'provider')
                        <a href="{{ route('site.provider.home') }}">
                            <div class="profile-item-img">
                                    <img src="{{ asset('site/images/avatar.svg') }}" alt="" />
                            </div>
                            {{ __('متجري') }}
                        </a>
                    @endif

                    <a href="" data-bs-toggle="modal" data-bs-target="#changePassword">

                        <div class="profile-item-img">
                            <img src="{{ asset('site') }}/images/mdi_password.svg" alt="" />
                        </div>
                        {{ __(' تغيير كلمة المرور') }}
                    </a>
                    <!--  -->
                    <a href="" data-bs-toggle="modal" data-bs-target="#deleteUser">

                        <div class="profile-item-img">
                            <img src="{{ asset('site') }}/images/trash.svg" alt="" />
                        </div>
                        {{ __('حذف الحساب') }}
                    </a>

                    <!--  -->
                    <a href="" data-bs-toggle="modal" data-bs-target="#logout">

                        <div class="profile-item-img">
                            <img src="{{ asset('site') }}/images/logout.svg" alt="" />
                        </div>
                        {{ __('تسجيل الخروج') }}
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

                        <form action="{{ route('site.profile.change-password') }}" method="POST" id="changePasswordForm">
                            @csrf
                            <h1>تغيير كلمة المرور</h1>


                            <div class="form-control-container">


                                <input type="password" id="password" name="password" placeholder=" كلمة المرور الجديدة"
                                    class="form-control" aria-describedby="passwordHelpBlock">
                            </div>
                            <div class="form-control-container">


                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="  تأكيد كلمة المرور الجديدة" class="form-control"
                                    aria-describedby="passwordHelpBlock">
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

                        <form action="{{ route('site.profile.delete-account') }}" method="POST">
                            @csrf

                            <h1> حذف الحساب</h1>




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

                        <form action="{{ route('site.logout') }}">


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

                        <form action="{{ route('site.profile.change-info') }}" method="POST" id="changeInfoForm">
                            @csrf

                            <h1> تعديل البيانات </h1>

                            <div class="form-control-container">

                                <input type="text" name="name" placeholder="الاسم"
                                    value="{{ auth()->user()->name }}" class="form-control"
                                    aria-describedby="passwordHelpBlock">
                            </div>

                            <div class="form-control-container">

                                <input type="text" name="email" value="{{ auth()->user()->email }}"
                                    placeholder=" البريد الالكتروني" class="form-control"
                                    aria-describedby="passwordHelpBlock">
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


@push('js')
    <script>
        $(document).ready(function() {
            $("#changeInfoForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                errorElement: "span",
                errorClass: "text-danger",
                highlight: function(element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element) {
                    $(element).removeClass("is-invalid");
                }
            });
        });

        $(document).ready(function() {

            $.validator.addMethod(
                "strongPassword",
                function(value, element) {
                    return this.optional(element) ||
                        /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/u.test(value);
                },
                "يجب أن تحتوي كلمة المرور على حرف كبير، حرف صغير، رقم، ورمز خاص على الأقل."
            );
            $("#changePasswordForm").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 8,
                        strongPassword: true,
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                errorElement: "p",
                errorClass: "text-danger",
                highlight: function(element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element) {
                    $(element).removeClass("is-invalid");
                }
            });
        });
    </script>
@endpush
