@extends('site.auth.layouts.app')

@section('content')
    <section class="auth login">
        <div class="logo">
            <img src="{{ asset('site') }}/images/logo.png" alt="">
        </div>
        <div class="vector">
            <img src="{{ asset('site') }}/images/future.svg" alt="">
        </div>
        <a href="" class="next">
            <i class="bi bi-chevron-right"></i>
        </a>
        <form action="{{ route('site.reset-password') }}" method="POST" id="passwordForm">
            @csrf
            <h1>كلمة المرور جديدة </h1>

            <div class="form-control-container">

                <input type="password" name="password" id="inputPassword5" placeholder="كلمة المرور" class="form-control"
                    aria-describedby="passwordHelpBlock">

                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control-container">

                <input type="password"  name="password_confirmation" id="inputPassword6" placeholder="تأكيد كلمة المرور"
                    class="form-control" aria-describedby="passwordHelpBlock">

                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <button type="submit" class="main_btn">
                التالى
            </button>

        </form>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#passwordForm").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 8,
                        confirmed: true
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
