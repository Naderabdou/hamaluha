@include('site.auth.layouts.app')
@section('content')
<section class="auth login">
          <div class="logo">
            <img src="{{asset('site/user')}}/images/logo.png" alt="">
          </div>
          <div class="vector">
            <img src="{{asset('site/user')}}/images/future.svg" alt="">
          </div>
          <a href="" class="next">
            <i class="bi bi-chevron-right"></i>
          </a>
          <form action="">
            <h1>كلمة المرور جديدة  </h1>




           <div class="input-check-code">
                <input type="text" name="code[]" maxlength="1" class="code-input">
                <input type="text" name="code[]" maxlength="1" class="code-input">
                <input type="text" name="code[]" maxlength="1" class="code-input">
                <input type="text" name="code[]" maxlength="1" class="code-input">
                <input type="text" name="code[]" maxlength="1" class="code-input">
            </div>

            <a href="" class="send-again">
                اعد ارسال الرمز؟
            </a>



            <button type="submit" class="main_btn">
              التالى
            </button>

          </form>
        </section>
@endsection
