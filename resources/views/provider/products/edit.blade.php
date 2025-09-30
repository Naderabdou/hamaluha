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
                <div class="product-header edit sec-header">
                    <h2 class="sub-header"> تعديل تفاصيل المنتج</h2>
                </div>

                <form action="" class="admin-form">


                    <div class="images-wrapper" id="imagesWrapper">
                        <!-- صورة -->
                        <div class="image-box">
                            <img src="https://via.placeholder.com/150" alt="Product">
                            <button type="button" class="delete-btn">&times;</button>
                        </div>

                        <!-- زر الإضافة -->
                        <div class="add-box" id="addImageBtn">+</div>
                    </div>

                    <!-- input file مخفي -->
                    <input type="file" id="imageInput" accept="image/*" hidden>


                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label"> اسم المنتج بالعربى</label>
                                <input type="text" class="form-control" placeholder="اسم المنتج" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">اسم المنتج بالانجليزى </label>
                                <input type="text" class="form-control" placeholder="   اسم المنتج بالانجليزى " />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label"> سعر المنتج </label>
                                <input type="text" class="form-control" placeholder="   اسم المنتج بالانجليزى " />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label"> نبذة عن المنتج </label>
                                <textarea class="form-control" rows="4" placeholder="اكتب نبذة عن المنتج"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
    </div>
@endsection
