<div class="row products-list">
    @forelse ($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <a href="{{ route('site.products.show', $product->slug) }}" class="best-seller-card">
                <div class="card-img">
                    <div class="rate">
                        <p>{{ $product->average_rating }}</p>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <img src="{{ $product->first_image->image_path }}" alt="{{ $product->name }}" />
                </div>
                <div class="card-body">
                    <span>{{ $product->store->name }}</span>
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->desc }}</p>
                </div>
                <div class="card-footer">
                    <div class="price">
                        @if ($product->discounted_price)
                            <p class="old-price" style="text-decoration: line-through; color: grey;">
                                {{ $product->price }}
                            </p>
                            {{ $product->discounted_price }}
                        @else
                            {{ $product->price }}
                        @endif
                        <img src="{{ asset('site/images/ryal.svg') }}" alt="">
                    </div>
                </div>
            </a>
        </div>
    @empty
        <p>لا توجد منتجات مطابقة.</p>
    @endforelse
</div>
