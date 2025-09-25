@extends('site.layouts.app')
@section('title', __('المفضلة'))

@section('header-class', 'pages')
@section('content')
    <section class="our-products">
        <div class="main-container">
            <h2 class="sub-title"> {{ __(' مفضلاتى') }}</h2>
            <p class="sub-paragraph">
                {{ __('  اكتشف جميع المتاجر الرقمية في منصتنا وتعرف على صنّاع المحتوي المتنوعين. تصفح منتجاتهم بسهولة واختر ما يناسب احتياجاتك.') }}

            </p>

            <!-- search & filter header -->
            <div class="all-products">
                <!-- products grid -->
                <div class="row">
                    @forelse($favourites as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="best-seller-card">
                                <div class="card-img">
                                    <div class="rate">
                                        <p>{{ number_format($product->rating ?? 0, 1) }}</p>
                                        <i class="bi bi-star-fill"></i>
                                    </div>

                                    <div class="favourite-icon">
                                        <a href="javascript:void(0)" class="toggle-fav" data-id="{{ $product->id }}">
                                            <i class="bi bi-heart-fill text-danger"></i>
                                        </a>
                                    </div>

                                    <img src="{{ $product->first_image->image_path }}" alt="{{ $product->name }}" />
                                </div>
                                <div class="card-body">
                                    <span>{{ $product->store->name ?? '' }}</span>
                                    <h3>{{ $product->name }}</h3>
                                    <p>{{ Str::limit($product->description, 80) }}</p>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="main_btn">
                                        اضف الى السلة
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.3346 10.9997C11.6883 10.9997 12.0274 11.1402 12.2774 11.3902C12.5275 11.6402 12.668 11.9794 12.668 12.333C12.668 12.6866 12.5275 13.0258 12.2774 13.2758C12.0274 13.5259 11.6883 13.6663 11.3346 13.6663C10.981 13.6663 10.6419 13.5259 10.3918 13.2758C10.1418 13.0258 10.0013 12.6866 10.0013 12.333C10.0013 11.593 10.5946 10.9997 11.3346 10.9997ZM0.667969 0.333008H2.84797L3.47464 1.66634H13.3346C13.5114 1.66634 13.681 1.73658 13.806 1.8616C13.9311 1.98663 14.0013 2.1562 14.0013 2.33301C14.0013 2.44634 13.968 2.55967 13.9213 2.66634L11.5346 6.97967C11.308 7.38634 10.868 7.66634 10.368 7.66634H5.4013L4.8013 8.75301L4.7813 8.83301C4.7813 8.87721 4.79886 8.9196 4.83012 8.95086C4.86137 8.98212 4.90377 8.99967 4.94797 8.99967H12.668V10.333H4.66797C4.31435 10.333 3.97521 10.1925 3.72516 9.94248C3.47511 9.69244 3.33464 9.3533 3.33464 8.99967C3.33464 8.76634 3.39464 8.54634 3.49464 8.35967L4.4013 6.72634L2.0013 1.66634H0.667969V0.333008ZM4.66797 10.9997C5.02159 10.9997 5.36073 11.1402 5.61078 11.3902C5.86083 11.6402 6.0013 11.9794 6.0013 12.333C6.0013 12.6866 5.86083 13.0258 5.61078 13.2758C5.36073 13.5259 5.02159 13.6663 4.66797 13.6663C4.31435 13.6663 3.97521 13.5259 3.72516 13.2758C3.47511 13.0258 3.33464 12.6866 3.33464 12.333C3.33464 11.593 3.92797 10.9997 4.66797 10.9997ZM10.668 6.33301L12.5213 2.99967H4.09464L5.66797 6.33301H10.668Z"
                                                fill="white" />
                                        </svg>
                                    </a>
                                    <div class="price">
                                        <img src="{{ asset('site/images/ryal.svg') }}" alt="" />
                                        {{ $product->price }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>لا توجد منتجات فى المفضلة</p>
                    @endforelse
                </div>

                <div class="mt-3">
                    {{ $favourites->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.toggle-fav', function() {
            let productId = $(this).data('id');
            let el = $(this);

            $.post("{{ url('/favourites/toggle') }}/" + productId, {
                _token: "{{ csrf_token() }}"
            }, function(data) {
                if (data.status === 'removed') {
                    el.find('i').removeClass('bi-heart-fill text-danger').addClass('bi-heart');
                } else {
                    el.find('i').removeClass('bi-heart').addClass('bi-heart-fill text-danger');
                }
            });
        });

        // Toggle filter box
        $('#toggleFilter').on('click', function() {
            $('#filtersBox').slideToggle();
        });
    </script>
@endpush
