@extends('site.auth.layouts.app')
@section('content')
        <section class="auth login">
          <div class="logo">
            <img src="{{asset('site')}}/images/logo.png" alt="">
          </div>
          <div class="vector">
            <img src="{{asset('site')}}/images/future.svg" alt="">
          </div>
          <a href="" class="next">
            <i class="bi bi-chevron-right"></i>
          </a>
          <form action="{{route('site.forget-password')}}" method="POST" id="emailForm">
            @csrf
            <h1>كلمة المرور جديدة  </h1>




            <div class="form-control-container">

                <label for="inputPassword5" class="form-label">يمكنك تغيير كامة المرور من خلال البريد الالكتروني الخاص بك</label>

              <input name="email" type="email" id="exampleFormControlInput1" placeholder="البريد الالكتروني" class="form-control" >

               @error('email')
                    <p class="text-danger">{{ $message }}</p>
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
@push('js')
    <script>
        $(document).ready(function() {
            $("#emailForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
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
