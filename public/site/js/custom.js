// Aos
AOS.init();

function animateCounters() {
  const counters = document.querySelectorAll('.counter');
  const duration = 2000; // 2 ثانية للكل
  const frameRate = 60; // فريمات في الثانية
  const totalFrames = Math.round(duration / (1000 / frameRate));

  counters.forEach(counter => {
    let frame = 0;
    const target = +counter.getAttribute('data-target');

    const updateCount = () => {
      frame++;
      const progress = frame / totalFrames;
      const current = Math.round(target * progress);

      counter.innerText = current;

      if (frame < totalFrames) {
        requestAnimationFrame(updateCount);
      } else {
        counter.innerText = target; // تأكيد يوصل للرقم النهائي
      }
    };

    updateCount();
  });
}

// IntersectionObserver لتشغيل العداد كل ما يظهر في الشاشة
const statsSection = document.querySelector('.stats');

if(statsSection){

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounters();
      }
    });
  }, { threshold: 0.5 });
  
  
  observer.observe(statsSection);
}



// owl

$('.best-seller-owl').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  dots: false,
  responsive: {
    0:{
      items:1,
            nav:false

    },
    520: {
      items: 2,
            nav:false
    },
    768: {
      items: 3,
      nav:false
    },
    1000: {
      items: 3,
      
    },
    1200:{
      items:4
    }
  }
})





$('.category-details-owl').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  dots: false,
  responsive: {
    0:{
      items:1,
            nav:false
    },
    520: {
      items: 2,
            nav:false
    },
    768: {
      items: 3,
      nav:false
    },
    1000: {
      items: 3,
      
    },
    1200:{
      items:4
    }
  }
})

// partner swiper


var swiper = new Swiper(".mySwiperPartner", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: 6, // الافتراضي
  loop: true,
  coverflowEffect: {
    rotate: 45,    
    stretch: -10,    
    depth: -85,    
    modifier: 1,    
    slideShadows: true,
  },
  autoplay: true,
  breakpoints: {
    320: {    // الهواتف الصغيرة
      slidesPerView: 2,
      coverflowEffect: {
        rotate: 30,
        stretch: 0,
        depth: -50,
      }
    },
    480: {   // الهواتف الأكبر
      slidesPerView: 2,
      coverflowEffect: {
        rotate: 35,
        stretch: -10,
        depth: -60,
      }
    },
    768: {   // التابلت
      slidesPerView: 3,
      coverflowEffect: {
        rotate: 40,
        stretch: -8,
        depth: -70,
      }
    },
    1024: {  // الشاشات الكبيرة
      slidesPerView: 5,
      coverflowEffect: {
        rotate: 45,
        stretch: -10,
        depth: -95,
      }
    }
  }
});


const showMenu = document.querySelector('.show-menu');

if (showMenu) {
  showMenu.addEventListener("click", () => {
    document.querySelector('.responsive-menu').classList.add("show")
    document.querySelector('.overlay').classList.add("show")
  })


  document.querySelector('.overlay').addEventListener("click", () => {
    document.querySelector('.responsive-menu').classList.remove("show")
    document.querySelector('.overlay').classList.remove("show")
  })


  document.querySelector('.remove-mune').addEventListener("click", () => {
    document.querySelector('.responsive-menu').classList.remove("show")
    document.querySelector('.overlay').classList.remove("show")
  })
}




// toggle filter
const toggleBtn = document.getElementById("toggleFilter");

 if(toggleBtn){
     const filtersBox = document.getElementById("filtersBox");

    // فتح/غلق عند الضغط على الزر
    toggleBtn.addEventListener("click", function (e) {
        e.stopPropagation(); // عشان ما يقفلش مباشرة
        filtersBox.classList.toggle("show");
    });

    // قفل عند الضغط خارج الفلتر
    document.addEventListener("click", function (e) {
        if (!filtersBox.contains(e.target) && e.target !== toggleBtn) {
            filtersBox.classList.remove("show");
        }
    });

 }



    // details slider



    function initSliders() {
  // Unslick لو كانت متفعلة بالفعل
  if ($('.slider-for').hasClass('slick-initialized')) {
    $('.slider-for').slick('unslick');
  }
  if ($('.slider-nav').hasClass('slick-initialized')) {
    $('.slider-nav').slick('unslick');
  }

  // إعادة تهيئة slider-for
  $('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    asNavFor: '.slider-nav'
  });

  // إعداد slider-nav حسب العرض
  const isMobile = $(window).width() <= 992;

  $('.slider-nav').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: false,
    centerMode: false,
    focusOnSelect: true,
    vertical: !isMobile // عمودي فقط إذا الشاشة أكبر من 992
  });
}

// أول تحميل
$(document).ready(function () {
  initSliders();
});

// إعادة تهيئة عند تغيير حجم الشاشة
$(window).on('resize', function () {
  clearTimeout(window.resizingSlick); // تأخير منعًا للتكرار
  window.resizingSlick = setTimeout(function () {
    initSliders();
  }, 300);
});



// verification code 

 document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.code-input');

        inputs.forEach((input, index) => {
            input.addEventListener('input', function() {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus(); // Focus on the next input
                }
            });

            input.addEventListener('keydown', function(event) {
                if (event.key === 'Backspace' && input.value.length === 0 && index > 0) {
                    inputs[index - 1].focus(); // Focus on the previous input when backspacing
                }
            });
        });
    });



    // upload img


     const fileInput = document.getElementById("fileInput");
  const preview = document.getElementById("preview");
  const uploadText = document.getElementById("uploadText");

  if(fileInput){

    fileInput.addEventListener("change", function () {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          preview.src = e.target.result;
          preview.style.display = "block";
          uploadText.style.display = "none";
        };
        reader.readAsDataURL(file);
      }
    });

  }



  // chat


    function sendMessage() {
      const input = document.getElementById("userInput");
      const text = input.value.trim();
      if (text === "") return;

      const chatBody = document.getElementById("chatBody");

      // إنشاء رسالة جديدة
      const msgDiv = document.createElement("div");
      msgDiv.className = "message user";
      msgDiv.innerHTML = text + '<div class="message-time">الآن</div>';

      chatBody.appendChild(msgDiv);
      chatBody.scrollTop = chatBody.scrollHeight; // ينزل لآخر الرسائل
      input.value = "";
    }