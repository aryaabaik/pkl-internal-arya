@extends('layouts.app')

@section('title', 'Wishlist Saya')
<style>
    /* SKELETON */
.wishlist-skeleton {
    height: 360px;
    border-radius: 22px;
    background: linear-gradient(
        100deg,
        #e5e7eb 30%,
        #f3f4f6 50%,
        #e5e7eb 70%
    );
    background-size: 400%;
    animation: shimmer 1.4s infinite;
}

@keyframes shimmer {
    from { background-position: 0% }
    to   { background-position: 100% }
}

/* MICRO ANIMATION */
.wishlist-item {
    animation: fadeUp .5s ease both;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px) }
    to   { opacity: 1; transform: translateY(0) }
}

/* CART BUTTON */
.wishlist-btn.cart {
    background: linear-gradient(135deg,#22c55e,#16a34a);
}

.wishlist-btn.cart:hover {
    transform: scale(1.03);
}

</style>
@section('content')
<div class="container py-5 wishlist-premium" id="wishlistApp">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="wishlist-title">💖 Wishlist Saya</h1>
        <span class="wishlist-count" id="wishlistCount">
            {{ $products->total() }} Produk
        </span>
    </div>

    {{-- Skeleton Loader --}}
    <div class="row g-4" id="wishlistSkeleton">
        @for($i=0;$i<8;$i++)
        <div class="col-6 col-md-4 col-xl-3">
            <div class="wishlist-skeleton"></div>
        </div>
        @endfor
    </div>

    {{-- Real Content --}}
    <div class="row g-4 d-none" id="wishlistContent">
        @foreach($products as $product)
        <div class="col-6 col-md-4 col-xl-3 wishlist-item" data-id="{{ $product->id }}">
            <div class="wishlist-card">

                <div class="wishlist-image">
                    <img src="{{ $product->image_url ?? asset('images/no-image.jpg') }}">

                    <button class="wishlist-remove ajax-remove"
                            data-url="{{ route('wishlist.toggle', $product) }}">
                        <i class="bi bi-heartbreak-fill"></i>
                    </button>
                </div>

                <div class="wishlist-body">
                    <h5>{{ $product->name }}</h5>

                    <div class="wishlist-price">
                        Rp {{ number_format($product->price) }}
                    </div>

                    <a href="{{ route('catalog.show', $product->slug) }}" class="wishlist-btn mb-2">
                        <i class="bi bi-eye"></i> Detail
                    </a>

                    <button class="wishlist-btn cart ajax-cart"
                            data-url="#">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                </div>

            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    // Skeleton Delay
    setTimeout(() => {
        document.getElementById('wishlistSkeleton').classList.add('d-none');
        document.getElementById('wishlistContent').classList.remove('d-none');
    }, 700);

    // Remove Wishlist
    document.querySelectorAll('.ajax-remove').forEach(btn => {
        btn.addEventListener('click', () => {
            fetch(btn.dataset.url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(() => {
                btn.closest('.wishlist-item').remove();
                updateCount(-1);
            });
        });
    });

    // Add to Cart
    document.querySelectorAll('.ajax-cart').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.innerHTML = '✔ Ditambahkan';
            fetch(btn.dataset.url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
        });
    });

    function updateCount(val){
        let count = document.getElementById('wishlistCount');
        count.innerText = (parseInt(count.innerText) + val) + ' Produk';
    }
});
</script>
@endsection

@endsection
