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
        <form action="{{ route('site.verify-code') }}" method="POST" id="verify-form">
            @csrf
            <h1>كلمة المرور جديدة</h1>

            <div class="input-check-code">
                <input type="text" maxlength="1" class="code-input">
                <input type="text" maxlength="1" class="code-input">
                <input type="text" maxlength="1" class="code-input">
                <input type="text" maxlength="1" class="code-input">
                <input type="text" maxlength="1" class="code-input">
                <input type="hidden" name="code" id="code">
            </div>
            <div id="code-error" style="color:red; margin-top:5px;"></div>

            <a href="{{ route('site.resend-code') }}" class="send-again">اعد ارسال الرمز؟</a>

            <button type="submit" class="main_btn">التالى</button>
        </form>

        <script>
            const form = document.getElementById('verify-form');
            form.addEventListener('submit', function(e) {
                let inputs = document.querySelectorAll('.code-input');
                let code = '';
                inputs.forEach(input => code += input.value);

                const errorDiv = document.getElementById('code-error');
                errorDiv.textContent = '';

                if (code.length < inputs.length) {
                    e.preventDefault();
                    errorDiv.textContent = 'من فضلك أدخل الكود بالكامل';
                    return;
                }


                document.getElementById('code').value = code;
            });

            const inputs = document.querySelectorAll('.code-input');
            inputs.forEach((input, index) => {
                input.addEventListener('input', () => {
                    if (input.value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && !input.value && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
            });
        </script>

    </section>
@endsection
