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

                <form action="" class="admin-form">
                    <!-- input file مخفي -->
                    <input type="file" id="imageInput" accept="image/*" hidden />

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label"> اسم المنتج بالعربى</label>
                                <input type="text" class="form-control" placeholder="اسم المنتج" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">اسم المنتج بالانجليزى
                                </label>
                                <input type="text" class="form-control" placeholder="   اسم المنتج بالانجليزى " />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label"> سعر المنتج </label>
                                <input type="text" class="form-control" placeholder="سعر المنتج " />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label checkboxLabel">
                                    <input type="checkbox" id="disableDiscountAdd" class="ms-2" />
                                    نسبة الخصم

                                </label>
                                <input disabled id="discountInputAdd" type="text" class="form-control"
                                    placeholder="نسبة الخصم" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="my-3">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>اختار التصنيف الرئيسى</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="my-3">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>اختار التصنيف الفرعى</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label"> نبذة عن المنتج </label>
                                <textarea class="form-control" rows="4" placeholder="اكتب نبذة عن المنتج"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="upload-box" id="product-upload-box">
                                <i class="fa-solid fa-upload"></i>
                                <p id="product-file-text">قم برفع المنتج</p>
                                <input type="file" name="product_file" id="product-file" />
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
                            <button type="submit" class="main_btn">إرسال</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
