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




            <div class="form-control-container">

                <label for="inputPassword5" class="form-label">يمكنك تغيير كامة المرور من خلال البريد الالكتروني الخاص بك</label>

              <input type="password" id="inputPassword5" placeholder="تأكيد كلمة المرور" class="form-control" aria-describedby="passwordHelpBlock">
            </div>


            <button type="submit" class="main_btn">
              التالى
            </button>

          </form>
        </section>
@endsection
