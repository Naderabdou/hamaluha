@extends('site.auth.layouts.app')
@section('content')
    <section class="auth login">
        <div class="logo">
            <img src="{{ asset('site') }}/images/logo.png" alt="">
        </div>
        <div class="vector">
            <img src="{{ asset('site') }}/images/future.svg" alt="">
        </div>
        <form action="{{ route('site.register') }}" method="POST" id="registerForm">
            @csrf
            <h1>انشئ حساب </h1>


            <div class="form-control-container">
                <input type="text" class="form-control" id="name" placeholder="اسم المستخدم " name="name" />
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-control-container">
                <input type="email" class="form-control" id="email" placeholder="البريد الالكترونى" name="email" />
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-control-container">

                <input type="password" name="password" id="password" placeholder="كلمة المرور" class="form-control"
                    aria-describedby="passwordHelpBlock">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control-container">

                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="تأكيد كلمة المرور" class="form-control" aria-describedby="passwordHelpBlock">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="middle">
                <p>
                    أو قم بالتسجيل بواسطة
                </p>
            </div>

            <div class="login-links">
                <a href="">
                    <img src="{{ asset('site') }}/images/icons_google.svg" alt="" />
                </a>
                <a href="">
                    <img src="{{ asset('site') }}/images/logos_facebook.svg" alt="" />
                </a>
                <a href="">
                    <img src="{{ asset('site') }}/images/logos_apple.svg" alt="" />
                </a>
            </div>

            <button type="submit" class="main_btn">
                تسجيل
            </button>
            <p class="create-acount">
                لديك حساب؟
                <a href="{{ route('site.login-form') }}">
                    تسجيل الدخول
                </a>
            </p>
        </form>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#registerForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                errorElement: "error",
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
