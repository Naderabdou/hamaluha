@extends('provider.layouts.app')
@section('title', 'إضافة عرض')

@section('content')
    <section class="product-details m-section">
        <div class="main-container">
            <div class="product-header sec-header">
                <h2 class="sub-header">اضف عرض</h2>
            </div>

            <form action="{{ route('site.provider.offers.store') }}" method="POST" enctype="multipart/form-data"
                class="admin-form">
                @csrf

                <div class="row">
                    <!-- اختيار المنتجات -->
                    <div class="col-12">
                        <div class="mb-3">
                            <select id="multi-select" name="products[]" multiple>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ app()->getLocale() === 'ar' ? $product->name_ar : $product->name_en }}
                                    </option>
                                @endforeach
                            </select>
                            @error('products')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <!-- نسبة الخصم -->
                    <div class="col-lg-12 col-md-12">
                        <div class="mb-3">
                            <input type="number" name="discount" min="0" class="form-control"
                                placeholder="نسبة الخصم" value="{{ old('discount') }}">
                            @error('discount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <!-- بداية العرض -->
                    <div class="col-lg-6 col-md-12">
                        <div class="mb-3">
                            <label for="start_at">بداية العرض</label>
                            <input type="date" name="start_at" id="start_at" class="form-control"
                                value="{{ old('start_at') }}">
                            @error('start_at')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- نهاية العرض -->
                    <div class="col-lg-6 col-md-12">
                        <div class="mb-3">
                            <label for="end_at">نهاية العرض</label>
                            <input type="date" name="end_at" id="end_at" class="form-control"
                                value="{{ old('end_at') }}">
                            @error('end_at')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <!-- الوصف -->
                    <div class="col-12">
                        <div class="mb-3">
                            <textarea name="desc_ar" class="form-control" rows="4" placeholder="اضف وصف للعرض">{{ old('desc_ar') }}</textarea>
                            @error('desc_ar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- صورة العرض -->
                    <div class="col-12">
                        <label class="upload-box2">
                            <div class="upload-text2">
                                <i class="fa-solid fa-plus"></i>
                                <p>أضف صورة للعرض</p>
                            </div>
                            <img id="preview" alt="صورة العرض" />
                            <input type="file" name="image" id="fileInput2" accept="image/*" />
                        </label>
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- زر الإرسال -->
                    <div class="col-12 btn-product">
                        <button type="submit" class="main_btn">إرسال</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

  
    {{-- معاينة الصورة --}}
    <script>
        document.getElementById('fileInput2').addEventListener('change', function(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('preview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#multi-select').select2({
                placeholder: "اختر المنتجات",
                allowClear: true
            });
        });
    </script>
@endsection
