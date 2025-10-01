@extends('provider.layouts.app')
@section('title', 'تعديل الملف الشخصي')

@section('content')
    <div class="app-data">
        <section class="m-section">
            <div class="main-container">
                <div class="profile-edit-header sec-header">
                    <h2 class="sub-header">تعديل الملف الشخصى</h2>
                </div>

                <form action="{{ route('site.provider.profile.update') }}" method="POST" enctype="multipart/form-data"
                    class="admin-form">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- صورة البروفايل -->
                        <div class="col-12">
                            <div class="profile-upload">
                                <img src="{{ $store && $store->image ? asset('storage/' . $store->image) : asset('site/images/stores2.png') }}"
                                    id="profile-img" alt="صورة البروفايل"
                                    style="width:120px;height:120px;border-radius:50%;object-fit:cover;" />

                                <!-- زر رفع صورة -->
                                <label class="upload-btn">
                                    <i class="fa-solid fa-camera"></i>
                                    <input type="file" name="image" id="profile-input" accept="image/*" hidden />
                                </label>
                            </div>
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- اسم المتجر -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">اسم المتجر</label>
                                <input type="text" name="store_name" class="form-control"
                                    value="{{ old('store_name', $store->name ?? '') }}" />
                                @error('store_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- نبذة عن المتجر -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">نبذة عن المتجر</label>
                                <textarea name="desc" class="form-control" rows="4">{{ old('desc', $store->desc ?? '') }}</textarea>
                                @error('desc')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- رقم التواصل -->
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">رقم التواصل</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $store->phone ?? '') }}" />
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- البريد الالكتروني -->
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">البريد الالكتروني</label>
                                <input type="email" name="store_email" class="form-control"
                                    value="{{ old('store_email', $store->email ?? '') }}" />
                                @error('store_email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- زر الحفظ -->
                        <div class="col-12 btn-product">
                            <button type="submit" class="main_btn">حفظ التعديلات</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
