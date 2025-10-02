@extends('provider.layouts.app')
@section('title', 'تعديل العرض')

@section('content')
    <section class="product-details m-section">
        <div class="main-container">
            <div class="product-header sec-header">
                <h2 class="sub-header">تعديل العرض</h2>
            </div>

            <form action="{{ route('site.provider.offers.update', $offer->id) }}" method="POST" enctype="multipart/form-data"
                class="admin-form">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- اختيار المنتجات -->
                    <div class="col-12">
                        <div class="mb-3">
                            <select id="multi-select" name="products[]" multiple>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ in_array($product->id, $offer->products->pluck('id')->toArray()) ? 'selected' : '' }}>
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
                            <input type="number" name="discount" min="0" step="1" class="form-control"
                                placeholder="نسبة الخصم" value="{{ old('discount', (int) $offer->discount) }}">

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
                                value="{{ old('start_at', isset($offer) && $offer->start_at ? \Carbon\Carbon::parse($offer->start_at)->format('Y-m-d') : '') }}">
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
                                value="{{ old('end_at', isset($offer) && $offer->end_at ? \Carbon\Carbon::parse($offer->end_at)->format('Y-m-d') : '') }}">
                            @error('end_at')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>



                    <!-- الوصف -->
                    <div class="col-12">
                        <div class="mb-3">
                            <textarea name="desc_ar" class="form-control" rows="4" placeholder="اضف وصف للعرض">{{ old('desc_ar', $offer->desc_ar) }}</textarea>
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

                            {{-- عرض الصورة القديمة لو موجودة --}}
                            <img id="preview"
                                src="{{ isset($offer) && $offer->image ? asset('storage/' . $offer->image) : asset('images/placeholder.png') }}"
                                alt="صورة العرض"
                                style="max-width: 200px; display: {{ isset($offer) && $offer->image ? 'block' : 'none' }};" />

                            <input type="file" name="image" id="fileInput2" accept="image/*" />
                        </label>

                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>




                    <!-- زر الإرسال -->
                    <div class="col-12 btn-product">
                        <button type="submit" class="main_btn">تحديث</button>
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
                let preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block'; // يظهر الصورة لما تختار واحدة جديدة
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
@endsection
