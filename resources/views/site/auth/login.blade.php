@include('site.auth.layouts.app')

@section('content')
        <section class="auth login">
          <div class="logo">
            <img src="{{asset('site/user')}}/images/logo.png" alt="">
          </div>
          <div class="vector">
            <img src="{{asset('site/user')}}/images/future.svg" alt="">
          </div>
          <form action="">
            <h1>تسجيل الدخول</h1>

            <div class="form-control-container">

              <input
                type="email"
                class="form-control"
                id="exampleFormControlInput1"
                placeholder="البريد الالكترونى"
              />
            </div>
            <div class="form-control-container">

              <input type="password" id="inputPassword5" placeholder="كلمة المرور" class="form-control" aria-describedby="passwordHelpBlock">
            </div>
              <a href="" class="forget"> نسيت كلمة المرور؟ </a>
            <div class="middle">
              <p>
                أو قم بتسجيل الدخول بواسطة
              </p>
            </div>

            <div class="login-links">
              <a href="">
                <img src="{{asset('site/user')}}/images/icons_google.svg" alt="" />
              </a>
              <a href="">
                <img src="{{asset('site/user')}}/images/logos_facebook.svg" alt="" />
              </a>
              <a href="">
                <img src="{{asset('site/user')}}/images/logos_apple.svg" alt="" />
              </a>
            </div>

            <button type="submit" class="main_btn">
              تسجيل الدخول
            </button>
            <p class="create-acount">
              ليس لديك حساب؟
              <a href="">
                انشئ حساب
              </a>
            </p>
          </form>
        </section>
@endsection
