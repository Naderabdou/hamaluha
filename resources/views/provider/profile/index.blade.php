@extends('provider.layouts.app')
@section('title', 'الملف الشخصي')

@section('content')
    <div class="app-data">
        <div class="profile m-section">
            <div class="profile-header">
                <h2>الملف الشخصى</h2>
                <a href="{{ route('site.provider.profile.edit') }}">تعديل البيانات</a>
            </div>

            <div class="profile-info">
                <div class="avatar">
                    <img src="{{ $store && $store->image ? asset('storage/' . $store->image) : asset('images/avatar.svg') }}"
                        alt="avatar" />
                </div>

                <h3>{{ $store->name }}</h3>


            </div>

            <section class="profile-details m-section">
                <div class="main-container">
                    <div class="profile-info">
                        <div class="info-card">
                            <p>البريد الالكترونى</p>
                            <span>{{ $store->email ?? $user->email }}</span>
                        </div>
                        <div class="info-card">
                            <p>رقم التواصل</p>
                            <span>{{ $store->phone ?? '-' }}</span>
                        </div>
                        <div class="info-card rate">
                            <p>التقييمات</p>
                            <span>
                                {{ $store->rating ?? '0.0' }} <i class="bi bi-star-fill"></i>

                            </span>
                        </div>
                    </div>

                    <div class="profile-info">
                        <p>نبذة عن المتجر</p>
                        <span>{{ $store->desc ?? '-' }}</span>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
