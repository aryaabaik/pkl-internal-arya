@extends('layouts.app')

@section('title', 'Wishlist Saya')

@section('content')
<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-bold mb-0">❤️ Wishlist Saya</h1>
        <span class="text-muted small">
            {{ $products->total() }} Produk
        </span>
    </div>

    @if($products->count())
        {{-- Produk Grid --}}
        <div class="row row-cols-2 row-cols-md-4 g-4 wishlist-grid">
            @foreach($products as $product)
                <div class="col wishlist-item">
                    <div class="wishlist-card h-100">
                        <x-product-card :product="$product" />
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-5 wishlist-pagination">
            {{ $products->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    @else
        {{-- Empty State --}}
        <div class="wishlist-empty text-center p-5 rounded-4 shadow-sm">
            <div class="mb-3">
                <i class="bi bi-heartbreak text-muted" style="font-size: 4rem;"></i>
            </div>
            <h3 class="h5 fw-semibold">Wishlist Kamu Masih Kosong</h3>
            <p class="text-muted mb-4">
                Yuk simpan produk favorit kamu biar nggak lupa ✨
            </p>
            <a href="{{ route('catalog.index') }}" class="btn btn-primary px-4">
                Jelajahi Produk
            </a>
        </div>
    @endif
</div>

{{-- Custom Style --}}
<style>
/* Card Hover */
.wishlist-card {
    transition: transform .25s ease, box-shadow .25s ease;
}
.wishlist-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0,0,0,.08);
}

/* Animasi Muncul */
.wishlist-item {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp .5s ease forwards;
}
.wishlist-item:nth-child(1) { animation-delay: .05s }
.wishlist-item:nth-child(2) { animation-delay: .1s }
.wishlist-item:nth-child(3) { animation-delay: .15s }
.wishlist-item:nth-child(4) { animation-delay: .2s }

@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Pagination Lebih Kecil */
.wishlist-pagination .pagination {
    gap: .25rem;
}
.wishlist-pagination .page-link {
    padding: .4rem .7rem;
    font-size: .85rem;
    border-radius: .5rem;
}

/* Empty State */
.wishlist-empty {
    background: linear-gradient(180deg, #f8f9fa, #ffffff);
}
</style>
@endsection
