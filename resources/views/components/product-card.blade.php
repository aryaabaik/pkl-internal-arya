@props(['product', 'variant' => null])

<div class="card h-100 border-0 shadow-sm product-card modern-card">
    {{-- IMAGE AREA --}}
    <div class="img-wrap position-relative overflow-hidden bg-light" style="padding-top: 90%;">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
             class="card-img-top position-absolute top-0 start-0 w-100 h-100 object-fit-cover image-main">

        {{-- discount badge (top-left) --}}
        @if($product->has_discount)
             <span class="badge bg-danger badge-top-left">-{{ $product->discount_percentage }}%</span>
        @endif

        {{-- wishlist (top-right) --}}
        <button class="btn btn-sm btn-light position-absolute top-0 end-0 m-2 wishlist-btn" title="Tambah Wishlist">
            <i class="bi bi-heart"></i>
        </button>

        {{-- subtle gradient overlay for readability --}}
        <div class="img-gradient-overlay position-absolute w-100 h-100" style="inset:0;pointer-events:none;"></div>

        {{-- Overlay CTA (appear on hover); hide Add button for new variant --}}
        <div class="card-overlay d-flex align-items-center justify-content-center gap-2">
            <a href="{{ route('catalog.show', $product->slug) }}" class="btn btn-sm btn-light fw-bold">Lihat</a>
            @unless($variant === 'new')
                <button class="btn btn-sm btn-primary ms-2 add-to-cart-btn">Tambah</button>
            @endunless
        </div>
    </div>

    {{-- INFO --}}
    <div class="card-body d-flex flex-column">
        <small class="text-muted mb-1">{{ $product->category->name }}</small>

        <a href="{{ route('catalog.show', $product->slug) }}" class="text-decoration-none stretched-link">
            <h6 class="card-title mb-2 product-title">{{ \Illuminate\Support\Str::limit($product->name, 60) }}</h6>
        </a>

        <div class="d-flex align-items-center justify-content-between mt-auto">
            <div class="price-block">
                @if($product->has_discount)
                    <div class="price-sale fw-bold text-white">{{ $product->formatted_price }}</div>
                    <div class="price-original text-white-50 small text-decoration-line-through">{{ $product->formatted_original_price }}</div>
                @else
                    <div class="price-base fw-bold text-dark">{{ $product->formatted_price }}</div>
                @endif
            </div>

            <div class="d-flex align-items-center gap-2 ms-2">
                <span class="badge bg-white text-dark rating-badge"><i class="bi bi-star-fill text-warning"></i> {{ $product->rating ?? '4.6' }}</span>
            </div>
        </div>
    </div>
</div>