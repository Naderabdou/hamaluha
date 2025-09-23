@extends('site.auth.layouts.app')

@section('content')
    <section class="auth login">
        <div class="logo">
            <img src="{{ asset('site') }}/images/logo.png" alt="">
        </div>
        <div class="vector">
            <img src="{{ asset('site') }}/images/future.svg" alt="">
        </div>
        <form action="{{ route('site.login') }}" method="POST" id="loginForm">
            @csrf
            <h1>تسجيل الدخول</h1>

            <div class="form-control-container">

                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="البريد الالكترونى"
                    name="email" />
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-control-container">

                <input type="password" name="password" id="inputPassword5" placeholder="كلمة المرور" class="form-control"
                    aria-describedby="passwordHelpBlock">
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <a href="{{ route('site.forget-password-form') }}" class="forget"> نسيت كلمة المرور؟ </a>
            <div class="middle">
                <p>
                    أو قم بتسجيل الدخول بواسطة
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
                تسجيل الدخول
            </button>
            <p class="create-acount">
                ليس لديك حساب؟
                <a href="{{ route('site.register-form') }}">
                    انشئ حساب
                </a>
            </p>
        </form>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#loginForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
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
