@extends('layouts.app')

@section('title', $product->name)

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
:root {
    --primary: #7c3aed;
    --primary-soft: #f5f3ff;
    --primary-dark: #5b21b6;
    --text-main: #0f172a;
    --text-muted: #64748b;
    --border-soft: rgba(15,23,42,.08);
    --grad: linear-gradient(135deg, #8b5cf6, #6d28d9);
}

body {
    background: #f8fafc;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text-main);
}

/* ================= BREADCRUMB ================= */
.breadcrumb a {
    color: var(--text-muted);
    text-decoration: none;
    font-weight: 500;
}
.breadcrumb a:hover {
    color: var(--primary);
}

/* ================= GALLERY ================= */
.gallery-card {
    background: #fff;
    border-radius: 28px;
    padding: 24px;
    border: 1px solid var(--border-soft);
    position: sticky;
    top: 90px;
}

.main-image-box {
    background: #fafafa;
    border-radius: 24px;
    height: 480px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

#main-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: transform .5s ease;
}

.main-image-box:hover #main-image {
    transform: scale(1.07);
}

.thumb-item {
    width: 76px;
    height: 76px;
    border-radius: 14px;
    object-fit: cover;
    cursor: pointer;
    border: 2px solid transparent;
    transition: .25s;
}

.thumb-item.active {
    border-color: var(--primary);
    box-shadow: 0 0 0 4px var(--primary-soft);
}

/* ================= INFO ================= */
.product-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--primary-soft);
    color: var(--primary);
    font-weight: 700;
    font-size: .8rem;
    padding: 6px 14px;
    border-radius: 999px;
    margin-bottom: 12px;
}

.product-title {
    font-size: 2.6rem;
    font-weight: 800;
    letter-spacing: -.02em;
}

.price-box {
    background: #fff;
    border-radius: 24px;
    padding: 28px;
    border: 1px solid var(--border-soft);
    margin: 28px 0;
}

.current-price {
    font-size: 2.4rem;
    font-weight: 800;
    color: var(--primary);
}

.old-price {
    text-decoration: line-through;
    color: var(--text-muted);
}

/* ================= ACTION ================= */
.qty-control {
    background: var(--primary-soft);
    border-radius: 999px;
    padding: 6px;
    display: inline-flex;
    align-items: center;
}

.qty-btn {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #fff;
    border: none;
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
}

.qty-input {
    width: 60px;
    border: none;
    background: transparent;
    text-align: center;
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--primary);
}

.btn-cart {
    background: var(--grad);
    color: #fff;
    border-radius: 999px;
    padding: 18px 36px;
    font-weight: 700;
    border: none;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 10px 25px rgba(124,58,237,.35);
}

.btn-cart:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(124,58,237,.45);
}

.btn-wishlist {
    border-radius: 999px;
    border: 2px solid var(--primary);
    padding: 12px 24px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-wishlist-active {
    background: var(--primary-soft);
    color: var(--primary);
}

.btn-wishlist-inactive {
    background: transparent;
    color: var(--primary);
}

.btn-wishlist:hover {
    background: var(--primary);
    color: #fff !important;
}

/* ================= TRUST ================= */
.trust-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin-top: 32px;
}

.trust-card {
    background: #fff;
    border: 1px solid var(--border-soft);
    border-radius: 18px;
    padding: 16px;
    display: flex;
    gap: 12px;
    align-items: center;
}

.trust-card i {
    font-size: 1.4rem;
    color: var(--primary);
}

.trust-card span {
    font-size: .85rem;
    font-weight: 600;
    color: var(--text-muted);
}
</style>
@endpush

@section('content')
<div class="container pb-5">

    {{-- BREADCRUMB --}}
    <nav class="py-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('catalog.index') }}">Catalog</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        {{-- GALLERY --}}
        <div class="col-lg-6">
            <div class="gallery-card">
                <div class="main-image-box position-relative">
                    @if($product->has_discount)
                        <span class="position-absolute top-0 start-0 m-4 badge rounded-pill fw-bold"
                              style="background: var(--primary); color:#fff;">
                            PROMO {{ $product->discount_percentage }}%
                        </span>
                    @endif
                    <img src="{{ $product->image_url }}" id="main-image" alt="{{ $product->name }}">
                </div>

                <div class="d-flex gap-3 justify-content-center mt-3 overflow-auto">
                    <img src="{{ $product->image_url }}" class="thumb-item active" onclick="changeImage(this)">
                    @foreach($product->images as $image)
                        <img src="{{ asset('storage/'.$image->image_path) }}" class="thumb-item" onclick="changeImage(this)">
                    @endforeach
                </div>
            </div>
        </div>

        {{-- INFO --}}
        <div class="col-lg-6">
            <span class="product-tag"><i class="bi bi-patch-check-fill"></i> Original Product</span>
            <h1 class="product-title mb-3">{{ $product->name }}</h1>

            <div class="d-flex align-items-center gap-3 mb-4">
                <div style="color:#facc15;">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-half"></i>
                </div>
                <span class="text-muted fw-semibold small">(Rating Produk • 4.8 / 5 )</span>
            </div>

            <div class="price-box">
                @if($product->has_discount)
                    <div class="old-price">{{ $product->formatted_original_price }}</div>
                @endif
                <div class="current-price">{{ $product->formatted_price }}</div>

                <hr class="my-4">

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="d-flex flex-wrap gap-3">
                        <div class="qty-control">
                            <button type="button" class="qty-btn" onclick="decrementQty()"><i class="bi bi-dash-lg"></i></button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="qty-input">
                            <button type="button" class="qty-btn" onclick="incrementQty()"><i class="bi bi-plus-lg"></i></button>
                        </div>

                        <button type="submit" class="btn-cart flex-grow-1" {{ $product->stock == 0 ? 'disabled' : '' }}>
                            <i class="bi bi-bag-plus-fill"></i>
                            {{ $product->stock == 0 ? 'Stok Habis' : 'Masukkan Keranjang' }}
                        </button>
                    </div>
                </form>

                @auth
                <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit"
                        class="btn-wishlist {{ auth()->user()->hasInWishlist($product) ? 'btn-wishlist-active' : 'btn-wishlist-inactive' }}">
                        <i class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                        {{ auth()->user()->hasInWishlist($product) ? 'Hapus dari Wishlist' : 'Simpan ke Wishlist' }}
                    </button>
                </form>
                @endauth
            </div>

            <h5 class="fw-bold mb-2">Tentang Produk</h5>
            <p class="text-muted lh-lg">{{ $product->description }}</p>

            <div class="trust-grid">
                <div class="trust-card"><i class="bi bi-truck"></i><span>Pengiriman Cepat</span></div>
                <div class="trust-card"><i class="bi bi-shield-check"></i><span>Garansi Resmi</span></div>
                <div class="trust-card"><i class="bi bi-arrow-repeat"></i><span>7 Hari Retur</span></div>
                <div class="trust-card"><i class="bi bi-headset"></i><span>CS 24/7</span></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function changeImage(el){
    const main = document.getElementById('main-image');
    main.style.opacity = 0;
    setTimeout(()=>{ main.src = el.src; main.style.opacity = 1; },200);
    document.querySelectorAll('.thumb-item').forEach(i=>i.classList.remove('active'));
    el.classList.add('active');
}
function incrementQty(){
    const i = document.getElementById('quantity');
    if(+i.value < +i.max) i.value++;
}
function decrementQty(){
    const i = document.getElementById('quantity');
    if(+i.value > 1) i.value--;
}
</script>
@endpush
@endsection
