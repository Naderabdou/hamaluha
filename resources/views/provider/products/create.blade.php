@extends('provider.layouts.app')
@section('title', __('Home'))
{{-- @title($settings->{'site_name_' . app()->getLocale()})
@description($settings->{'about_desc_' . app()->getLocale()})
@image(asset('storage/' . $settings->logo)) --}}
@section('content')
    <div class="app-data">
        <!-- product-details -->

        <section class="product-details m-section">
            <div class="main-container">
                <div class="product-header sec-header">
                    <h2 class="sub-header">اضف منتج</h2>
                </div>

                <form action="{{ route('site.provider.products.store') }}" id="createProductForm" method="POST" enctype="multipart/form-data"
                    class="admin-form">
                    @csrf
                    <!-- input file مخفي -->
                    {{-- <input type="file" id="imageInput" accept="image/*"  /> --}}

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label"> اسم المنتج بالعربى</label>
                                <input type="text" name="name_ar" class="form-control" placeholder="اسم المنتج" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">اسم المنتج بالانجليزى
                                </label>
                                <input type="text" name="name_en" class="form-control"
                                    placeholder="   اسم المنتج بالانجليزى " />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label"> سعر المنتج </label>
                                <input type="text" name="price" class="form-control" placeholder="سعر المنتج " />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 row">
                            <div class="mb-3 col-4">
                                <label class="form-label checkboxLabel">
                                    <input type="checkbox" name="hasDiscount" id="disableDiscountAdd" class="ms-2" />
                                    نسبة الخصم

                                </label>
                                <input disabled class="discountInputAdd" name="discount" type="text" class="form-control"
                                    placeholder="نسبة الخصم" />
                            </div>
                            <div class="mb-3 col-4">
                                <label class="form-label checkboxLabel">
                                    تاريخ البداية

                                </label>
                                <input disabled class="discountInputAdd" name="start_at" type="datetime-local" class="form-control"
                                    placeholder="نسبة الخصم" />
                            </div>
                            <div class="mb-3 col-4">
                                <label class="form-label checkboxLabel">
                                    تاريخ النهاية

                                </label>
                                <input disabled class="discountInputAdd" name="end_at" type="datetime-local" class="form-control"
                                    placeholder="نسبة الخصم" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="my-3">
                                <select id="mainCategory" class="form-select">
                                    <option selected disabled>اختار التصنيف الرئيسى</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" data-children='@json($category->children)'>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="my-3">
                                <select id="subCategory" name="category" class="form-select">
                                    <option selected disabled>اختار التصنيف الفرعى</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">وصف المنتج بالعربىة</label>
                                <textarea class="form-control" name="desc_ar" rows="4" placeholder="اكتب نبذة عن المنتج"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">وصف المنتج بالانجليزىة</label>
                                <textarea class="form-control" name="desc_en" rows="4" placeholder="اكتب نبذة عن المنتج"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="upload-box" id="product-upload-box">
                                <i class="fa-solid fa-upload"></i>
                                <p id="product-file-text">قم برفع المنتج</p>
                                <input type="file" name="file" id="product-file" />
                            </label>
                        </div>

                        <!-- إضافة صور للمنتج -->
                        <div class="col-md-6">
                            <label class="upload-box">
                                <i class="fa-solid fa-plus"></i>
                                <p>أضف صور للمنتج</p>
                                <input type="file" name="product_images[]" id="product-images" multiple />
                            </label>
                            <div class="preview-container" id="preview-container"></div>
                        </div>

                        <div class="col-12 btn-product">
                            <button type="submit" class="main_btn">اضافة</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script>
        document.getElementById('mainCategory').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            let children = JSON.parse(selectedOption.getAttribute('data-children'));
            let subCategory = document.getElementById('subCategory');

            // فضّي اللي موجود
            subCategory.innerHTML = '<option selected disabled>اختار التصنيف الفرعى</option>';

            if (children.length > 0) {
                children.forEach(function(child) {
                    let option = document.createElement('option');
                    option.value = child.id;
                    option.textContent = child.name;
                    subCategory.appendChild(option);
                });
            } else {
                let option = document.createElement('option');
                option.textContent = 'لا يوجد تصنيفات فرعية';
                option.disabled = true;
                subCategory.appendChild(option);
            }
        });
    </script>
     <script>
        $(document).ready(function() {
            $("#createProductForm").validate({
                rules: {
                    name_ar: {
                        required: true,
                        minlength: 3
                    },
                    name_en: {
                        required: true,
                        minlength: 3
                    },
                    price: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    discount: {
                        number: true,
                        min: 0,
                        max: 100
                    },
                    category: {
                        required: true
                    },
                    desc_ar: {
                        required: true,
                        minlength: 5
                    },
                    desc_en: {
                        required: true,
                        minlength: 5
                    },
                    file: {
                        required: true,
                        extension: "jpg|jpeg|png|webp|pdf"
                    },
                    "product_images[]": {
                        extension: "jpg|jpeg|png|webp"
                    }
                },
                errorElement: "span",
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
