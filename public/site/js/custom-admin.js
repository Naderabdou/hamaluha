
// side bar minimize

let siderMinBtn = document.querySelectorAll(".nav-toggle");
let mainApp = document.querySelector(".main-app");

siderMinBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (window.innerWidth < 992) {
      // للشاشات الصغيرة
      mainApp.classList.toggle("nav_open");
    } else {
      // للشاشات الكبيرة
      mainApp.classList.toggle("side-bar-minimize");
    }
  });
});

// لما يتغير حجم الشاشة
window.addEventListener("resize", () => {
  if (window.innerWidth >= 992) {
    // لو الشاشة كبيرة نشيل nav_open
    mainApp.classList.remove("nav_open");
  } else {
    // لو الشاشة صغيرة نشيل side-bar-minimize
    mainApp.classList.remove("side-bar-minimize");
  }
});


// 
let navMinBtn = document.querySelector(".nav-toggle-dots");
let mainNav = document.querySelector(".content-app");

if(navMinBtn){

  
navMinBtn.addEventListener("click", () => {
  if (window.innerWidth < 992) {
    // للشاشات الصغيرة
    console.log("ghjhu");

    mainNav.classList.toggle("bar-open");
  } else {
    // للشاشات الكبيرة
    console.log("ghjhuttttttt");
  }
});

}


// 





document.querySelectorAll('.more-btn').forEach(btn => {
  btn.addEventListener('click', function (e) {
    const menu = this.nextElementSibling;
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    btn.parentElement.parentElement.classList.add('active');
  });
});

// إخفاء القائمة عند الضغط خارجها
document.addEventListener('click', function(e) {
  document.querySelectorAll('.dropdown-menu').forEach(menu => {
    if (!menu.previousElementSibling.contains(e.target) && !menu.contains(e.target)) {
      menu.style.display = 'none';
    }
  });
});





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




// 

   function initDeleteButtons() {
    document.querySelectorAll(".delete-btn").forEach((btn) => {
      btn.onclick = function () {
        this.closest(".accordion-item").remove();
      };
    });
  }
  initDeleteButtons();

  // كود الإضافة
  let itemCount = 1; // عداد للعناصر

  document.getElementById("saveAccordionItem").addEventListener("click", function () {
    const title = document.getElementById("accordionTitle").value.trim();
    const body = document.getElementById("accordionBody").value.trim();

    if (!title || !body) {
      alert("من فضلك املأ الحقول!");
      return;
    }

    itemCount++;
    const newId = "collapse-" + itemCount;

    const newItem = `
      <div class="accordion-item mb-3 position-relative">
        <h2 class="accordion-header">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#${newId}"
            aria-expanded="false"
            aria-controls="${newId}"
          >
            ${title}
          </button>
        </h2>
        <div id="${newId}" class="accordion-collapse collapse">
          <div class="accordion-body">
            <div class="main-container">
              <p>${body}</p>
            </div>
          </div>
        </div>
        <button
          type="button"
          class="btn btn-link text-danger delete-btn position-absolute top-50  translate-middle-y"
          style="font-size: 1.4rem;"
        >
          <i class="fa-solid fa-trash"></i>
        </button>
      </div>
    `;

    document.getElementById("accordionExample").insertAdjacentHTML("beforeend", newItem);

    // إعادة تفعيل أزرار الحذف
    initDeleteButtons();

    // قفل المودال
    const modal = bootstrap.Modal.getInstance(document.getElementById("addAccordionModal"));
    modal.hide();

    // تفريغ الحقول
    document.getElementById("accordionTitle").value = "";
    document.getElementById("accordionBody").value = "";
  });





  // 

  
  const imageInput = document.getElementById("imageInput");
  const addImageBtn = document.getElementById("addImageBtn");
  const imagesWrapper = document.getElementById("imagesWrapper");

  
 
    
      // حذف صورة
  document.addEventListener("click", function (e) {
    if (e.target.classList.contains("delete-btn")) {
      e.target.closest(".image-box").remove();
    }
  });


   if(addImageBtn){


  // عند الضغط على + نفتح اختيار الملفات
  addImageBtn.addEventListener("click", function () {
    imageInput.click();
  });

  // لما المستخدم يختار صورة
  imageInput.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const newImage = `
          <div class="image-box">
            <img src="${e.target.result}" alt="Product">
            <button type="button" class="delete-btn">&times;</button>
          </div>
        `;
        addImageBtn.insertAdjacentHTML("beforebegin", newImage);
      };
      reader.readAsDataURL(file);
    }
    this.value = ""; // علشان لو اختار نفس الصورة تاني يشتغل
  });



  }

  // 



   // إظهار اسم الملف في مربع رفع المنتج
    const productFileInput = document.getElementById('product-file');
    const productFileText = document.getElementById('product-file-text');

    console.log("dsgfedsgfe");
    

    if(productFileInput){

      productFileInput.addEventListener('change', function () {
        if (this.files.length > 0) {
          productFileText.textContent = this.files[0].name;
        } else {
          productFileText.textContent = "قم برفع المنتج";
        }
      });


    }





    // عرض الصور المرفوعة + زرار حذف
    const productImagesInput = document.getElementById('product-images');
    const previewContainer = document.getElementById('preview-container');



    if(productImagesInput){

      productImagesInput.addEventListener('change', function () {
        Array.from(this.files).forEach(file => {
          const reader = new FileReader();
          reader.onload = function (e) {
            const previewItem = document.createElement('div');
            previewItem.classList.add('preview-item');
            previewItem.innerHTML = `
              <img src="${e.target.result}" alt="صورة المنتج">
              <button class="remove-btn">&times;</button>
            `;
            previewContainer.appendChild(previewItem);
  
            // زرار الحذف
            previewItem.querySelector('.remove-btn').addEventListener('click', function () {
              previewItem.remove();
            });
          }
          reader.readAsDataURL(file);
        });
  
        // مسح القيمة عشان تقدر ترفع نفس الصورة تاني لو حبيت
        this.value = "";
      });


    }



    // 



     // معاينة الصورة بعد الرفع
    const input = document.getElementById('profile-input');
    const img = document.getElementById('profile-img');


    if(input){

      input.addEventListener('change', function () {
        if (this.files && this.files[0]) {
          const reader = new FileReader();
          reader.onload = function (e) {
            img.src = e.target.result;
          };
          reader.readAsDataURL(this.files[0]);
        }
      });


    }




    // 

    const multiSelect = document.getElementById("multi-select");

    if(multiSelect){

      $(document).ready(function() {
 
 
       $('#multi-select').select2({
         placeholder: "ابحث واختر المنتجات",
         allowClear: true
       });
     });

    }



    // 


     const fileInput = document.getElementById('fileInput2');
    const preview = document.getElementById('preview');
    const uploadText = document.querySelector('.upload-text2');



    if(fileInput){

      fileInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
          const reader = new FileReader();
          reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            uploadText.style.background = 'white';
          };
          reader.readAsDataURL(this.files[0]);
        }
      });
    }



    // 


    
      
  const checkbox = document.getElementById("disableDiscountAdd");
    const discountInput = document.getElementById("discountInputAdd");

    checkbox.addEventListener("change", function () {
      discountInput.disabled = !this.checked;
    });