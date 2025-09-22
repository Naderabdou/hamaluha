 <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

 <script src="https://code.jquery.com/jquery-3.4.1.min.js"
     integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
     integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
 </script>
 <script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
 </script>
 <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
 <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
 <script src="{{ asset('site/js/anime.min.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
 <script src="{{ asset('site/js/owl.carousel.min.js') }}"></script>

 <!-- dataTables -->
 <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
 <script src="{{ asset('site/js/dataTable.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

 <script src="{{ asset('site/js/custom.js') }}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 @if (app()->getLocale() == 'ar')
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ar.min.js"></script>
 @else
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_en.min.js"></script>
 @endif

 @if (session()->has('success'))
     <script>
         Swal.fire({
             toast: true,
             position: 'top-end',
             icon: 'success',
             title: "{{ session()->get('success') }}",
             showConfirmButton: false,
             timer: 4000,
             timerProgressBar: true
         })
     </script>
 @endif

 @if (session()->has('error'))
     <script>
         Swal.fire({
             toast: true,
             position: 'top-end',
             icon: 'error',
             title: "{{ session()->get('error') }}",
             showConfirmButton: false,
             timer: 4000,
             timerProgressBar: true
         })
     </script>
 @endif

 <script>
     @php
         $messages = [
             'phoneMessage' => __('رقم الهاتف يجب أن يكون رقمًا محليًا سعوديًا يبدأ بـ 05.'),
             'emailmessage' => __('الرجاء ادخال الايميل من نطاق (gmail, yahoo, hotmail, outlook)'),
             'phoneMinLengthMessage' => __('يجب ان لا يقل الهاتف عن 10 ارقام'),
             'phoneMaxLengthMessage' => __('يجب ان لا يزيد الهاتف عن 15 رقم'),
             'stringMessage' => __('يجب ان يحتوي علي حروف فقط'),
             'noSpecialChars' => __('لا يمكن استخدام الرموز الخاصة'),
             'fullname' => __('يجب ادخال الاسم الثلاثي'),
         ];
     @endphp

     @foreach ($messages as $key => $message)
         window.{{ $key }} = "{{ $message }}";
     @endforeach
 </script>

 <script>
     $(document).ready(function() {

         // تعريف الميثودز المخصصة
         $.validator.addMethod("noSpecialChars", function(value, element) {
             return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF ]*$/.test(value);
         }, window.noSpecialChars);

         $.validator.addMethod("domain", function(value, element) {
             return this.optional(element) ||
                 /^[\w.-]+@(gmail\.com|yahoo\.com|hotmail\.com|outlook\.com)$/.test(value);
         }, window.emailmessage);

         $.validator.addMethod("phone_type", function(value, element) {
             return this.optional(element) || /^[0-9+]+$/.test(value);
         }, window.phoneMessage);

         $.validator.addMethod('string', function(value, element) {
             return this.optional(element) || /^[\u0600-\u06FFa-zA-Z\s]+$/i.test(value);
         }, window.stringMessage);

         $.validator.addMethod("fullname", function(value, element) {
             var words = value.trim().split(/\s+/);
             return this.optional(element) || (words.length >= 3);
         }, window.fullname);

         // تشغيل الفاليديشن
         $("#contact_form").validate({
             rules: {
                 name: {
                     required: true,
                     minlength: 4,
                     maxlength: 50,
                     noSpecialChars: true,
                     string: true,
                 },
                 email: {
                     required: true,
                     minlength: 3,
                     email: true,
                     maxlength: 50,
                 },
                 phone: {
                     required: true,
                     minlength: 10,
                     maxlength: 15,
                     phone_type: true,
                 },
                 message: {
                     required: true,
                     minlength: 3,
                 },
             },

             messages: {
                 phone: {
                     minlength: window.phoneMinLengthMessage,
                     maxlength: window.phoneMaxLengthMessage,
                 }
             },


             errorElement: "span",
             errorLabelContainer: ".errorTxt",

             submitHandler: function(form) {
                 var formData = new FormData(form);
                 let url = form.action;
                 $('.ctm-btn-contact').prop('disabled', true);
                 // Hide the button
                 $('.ctm-btn').hide();


                 // Add a spinner
                 $('.ctm-btn-contact').parent().append(
                     `<div class="spinner-border"  style="width: 3rem;height: 3rem;margin: auto;/* padding: 24px; */display: flex;"   role="status">
                <span class="sr-only">Loading...</span>
                </div>
                    `
                 );

                 $.ajax({
                     url: url,
                     method: 'POST',
                     data: formData,
                     processData: false,
                     contentType: false,
                     success: function(data) {
                         form.reset();
                         Swal.fire({
                             icon: 'success',
                             title: `<h5>${data.success}</h5>`,
                             showConfirmButton: false,
                             timer: 2000
                         });
                         $('.ctm-btn-contact').prop('disabled', false);


                         // Show the button
                         $('.ctm-btn-contact').show();

                         // Remove the spinner
                         $('.ctm-btn-contact').next('.spinner-border')
                             .remove();
                     },
                     error: function(data) {
                         swal.fire({
                             icon: 'error',
                             title: `<h5>${data.responseJSON.error}</h5>`,
                             showConfirmButton: false,
                             timer: 4000
                         });
                         $('.ctm-btn-contact').prop('disabled', false);


                         // Show the button
                         $('.ctm-btn-contact').show();

                         // Remove the spinner
                         $('.ctm-btn-contact').next('.spinner-border')
                             .remove();
                     },
                 });
             },
         });
         $("#subscribe-form").validate({
             rules: {

                 email: {
                     required: true,
                     minlength: 3,
                     email: true,
                     maxlength: 50,
                 },

             },



             errorElement: "span",
             errorLabelContainer: ".errorTxt",

             submitHandler: function(form) {
                 var formData = new FormData(form);
                 let url = form.action;
                 $('.ctm-btn-subscribe').prop('disabled', true);
                 // Hide the button
                 $('.ctm-btn-subscribe').hide();


                 // Add a spinner
                 $('.ctm-btn-subscribe').parent().append(
                     `<div class="spinner-border"  style="width: 3rem;height: 3rem;margin: auto;/* padding: 24px; */display: flex;"   role="status">
                <span class="sr-only">Loading...</span>
                </div>
                    `
                 );

                 $.ajax({
                     url: url,
                     method: 'POST',
                     data: formData,
                     processData: false,
                     contentType: false,
                     success: function(data) {
                         form.reset();
                         Swal.fire({
                             icon: 'success',
                             title: `<h5>${data.success}</h5>`,
                             showConfirmButton: false,
                             timer: 2000
                         });
                         $('.ctm-btn-subscribe').prop('disabled', false);


                         // Show the button
                         $('.ctm-btn-subscribe').show();

                         // Remove the spinner
                         $('.ctm-btn-subscribe').next('.spinner-border')
                             .remove();
                     },
                     error: function(data) {
                         swal.fire({
                             icon: 'error',
                             title: `<h5>${data.responseJSON.error}</h5>`,
                             showConfirmButton: false,
                             timer: 4000
                         });
                         $('.ctm-btn-subscribe').prop('disabled', false);


                         // Show the button
                         $('.ctm-btn-subscribe').show();

                         // Remove the spinner
                         $('.ctm-btn-subscribe').next('.spinner-border')
                             .remove();
                     },
                 });
             },
         });

         // تفعيل AOS
         AOS.init();
     });
 </script>

 <script>
     $(document).ready(function() {

         // قواعد مخصصة
         $.validator.addMethod("string", function(value, element) {
             return this.optional(element) || /^[\u0600-\u06FFa-zA-Z\s]+$/i.test(value);
         }, "يجب أن يحتوي على حروف فقط");

         $.validator.addMethod("domain", function(value, element) {
             return this.optional(element) ||
                 /^[\w.-]+@(gmail\.com|yahoo\.com|hotmail\.com|outlook\.com)$/.test(value);
         }, "الرجاء إدخال بريد إلكتروني صحيح من النطاقات المسموح بها");

         $.validator.addMethod("phone_type", function(value, element) {
             return this.optional(element) || /^[0-9+]+$/.test(value);
         }, "رقم الهاتف يجب أن يكون أرقام فقط");

         // validation
         $("#volunteerForm").validate({
             rules: {
                 first_name: {
                     required: true,
                     minlength: 4,
                     string: true
                 },
                 last_name: {
                     required: true,
                     minlength: 4,
                     string: true
                 },
                 email: {
                     required: true,
                     email: true,
                     domain: true
                 },
                 phone: {
                     required: true,
                     minlength: 10,
                     maxlength: 15,
                     phone_type: true,
                 },
                 age: {
                     required: true,
                     number: true,
                     min: 18,
                     max: 60
                 },
                 address: {
                     required: true,
                     minlength: 3
                 },
                 education: {
                     required: true,
                     minlength: 4,
                     string: true
                 }
             },
             messages: {
                 first_name: {
                     required: "الاسم الأول مطلوب",
                     minlength: "الاسم الأول يجب أن يكون 4 أحرف على الأقل",
                 },
                 last_name: {
                     required: "الاسم الثاني مطلوب",
                     minlength: "الاسم الثاني يجب أن يكون 4 أحرف على الأقل",
                 },
                 email: {
                     required: "البريد الإلكتروني مطلوب",
                     email: "صيغة البريد غير صحيحة",
                 },
                 phone: {
                     required: "رقم الجوال مطلوب",
                     minlength: "يجب أن لا يقل عن 10 أرقام",
                     maxlength: "يجب أن لا يزيد عن 15 رقم",
                 },
                 age: {
                     required: "العمر مطلوب",
                     number: "العمر يجب أن يكون رقم",
                     min: "العمر يجب أن يكون 18 أو أكثر",
                     max: "العمر يجب أن لا يزيد عن 60",
                 },
                 address: {
                     required: "مكان السكن مطلوب",
                     minlength: "مكان السكن يجب أن يكون 3 أحرف على الأقل",
                 },
                 education: {
                     required: "المؤهل العلمي مطلوب",
                     minlength: "المؤهل العلمي يجب أن يكون 4 أحرف على الأقل",
                 }
             },
             errorElement: "small",
             errorClass: "text-danger",
             errorPlacement: function(error, element) {
                 element.closest('.mb-3, .col-md-6').find('small.text-danger').html(error);
             },
             success: function(label, element) {
                 $(element).closest('.mb-3, .col-md-6').find('small.text-danger').html('');
             },
             submitHandler: function(form) {
                 form.submit();
             }
         });

     });
 </script>
 <script>
$(document).ready(function () {
    $("#contactForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                string: true
            },
            email: {
                required: true,
                email: true,
                domain: true
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 15,
                phone_type: true,
            },
            message: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            name: {
                required: "الاسم مطلوب",
                minlength: "الاسم يجب أن يكون 3 أحرف على الأقل",
            },
            email: {
                required: "البريد الإلكتروني مطلوب",
                email: "صيغة البريد غير صحيحة",
            },
            phone: {
                required: "رقم الجوال مطلوب",
                minlength: "يجب أن لا يقل عن 10 أرقام",
                maxlength: "يجب أن لا يزيد عن 15 رقم",
            },
            message: {
                required: "الرسالة مطلوبة",
                minlength: "الرسالة يجب أن تكون 5 أحرف على الأقل",
            }
        },
        errorElement: "small",
        errorClass: "text-danger",
        errorPlacement: function (error, element) {
            element.closest('.mb-3').find('small.text-danger').html(error);
        },
        success: function (label, element) {
            $(element).closest('.mb-3').find('small.text-danger').html('');
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
</script>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
     document.querySelectorAll('.card-donation').forEach(function(card) {
         card.addEventListener('click', function(e) {
             e.preventDefault();

             Swal.fire({
                 title: 'تنويه',
                 text: 'جاري العمل على تفعيل خدمات الدفع الإلكتروني',
                 icon: 'info',
                 confirmButtonText: 'تمام'
             });
         });
     });
 </script>

 <script>
     $(document).on('click', '.open-job-modal', function(e) {
         e.preventDefault();

         var currentModal = $(this).data('current');
         var targetModal = $(this).data('target');

         $(currentModal).modal('hide'); // يقفل الحالي

         $(currentModal).on('hidden.bs.modal', function() {
             $(targetModal).modal('show'); // يفتح الجديد بعد ما يتقفل القديم
         });
     });
 </script>
 @stack('js')
