@extends('layouts.app')

@section('title', $product->name)

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    :root {
        /* Purple Gradient Theme */
        --primary-purple: #7c3aed;
        --secondary-purple: #f5f3ff;
        --accent-purple: #c4b5fd;
        --text-main: #1e1b4b;
        --text-light: #6b7280;
        /* Gradient Button & Elements */
        --grad-purple: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
    }

    body {
        background-color: #f8fafc;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text-main);
    }

    /* Breadcrumb Styles */
    .breadcrumb-wrapper { padding: 20px 0; }
    .breadcrumb-item a { color: var(--text-light); text-decoration: none; font-weight: 500; transition: 0.3s; }
    .breadcrumb-item a:hover { color: var(--primary-purple); }

    /* Image Section */
    .product-gallery-card {
        background: white;
        border-radius: 32px;
        padding: 24px;
        border: 1px solid #f1f5f9;
        position: sticky;
        top: 100px;
        box-shadow: 0 10px 40px rgba(124, 58, 237, 0.05);
    }

    .main-img-holder {
        background: #fdfdff;
        border-radius: 24px;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 20px;
        position: relative;
    }

    #main-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .main-img-holder:hover #main-image { transform: scale(1.08); }

    .thumb-item {
        width: 80px;
        height: 80px;
        border-radius: 16px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: 0.3s;
        object-fit: cover;
    }

    .thumb-item.active { border-color: var(--primary-purple); box-shadow: 0 0 0 4px var(--secondary-purple); }

    /* Info Section */
    .product-details { padding-left: 20px; }

    .brand-tag {
        color: var(--primary-purple);
        background: var(--secondary-purple);
        padding: 6px 16px;
        border-radius: 100px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-block;
        margin-bottom: 12px;
    }

    .product-title {
        font-size: 2.8rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        line-height: 1.2;
    }

    .price-wrapper {
        background: white;
        padding: 30px;
        border-radius: 24px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 10px 30px rgba(124, 58, 237, 0.06);
        margin: 24px 0;
    }

    .current-price { font-size: 2.5rem; font-weight: 800; color: var(--primary-purple); }
    .old-price { text-decoration: line-through; color: var(--text-light); font-size: 1.1rem; }

    /* Controls */
    .qty-control {
        background: var(--secondary-purple);
        border-radius: 100px;
        padding: 6px;
        display: inline-flex;
        align-items: center;
    }

    .qty-btn {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: none;
        background: white;
        color: var(--primary-purple);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        transition: 0.2s;
    }

    .qty-input {
        width: 60px;
        border: none;
        background: transparent;
        text-align: center;
        font-weight: 700;
        font-size: 1.2rem;
        color: var(--primary-purple);
    }

    /* Buttons */
    .btn-cart-premium {
        background: var(--grad-purple);
        color: white;
        border: none;
        padding: 18px 40px;
        border-radius: 100px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        transition: 0.3s;
        box-shadow: 0 10px 25px rgba(124, 58, 237, 0.3);
    }

    .btn-cart-premium:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(124, 58, 237, 0.4);
        color: white;
    }

    /* New Purple Wishlist Style */
    .btn-wishlist-premium {
        border-radius: 100px;
        padding: 12px 24px;
        font-weight: 700;
        transition: 0.3s;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: 2px solid var(--primary-purple);
    }

    .btn-wishlist-active {
        background: var(--secondary-purple);
        color: var(--primary-purple);
        border-color: var(--primary-purple);
    }

    .btn-wishlist-inactive {
        background: transparent;
        color: var(--primary-purple);
        border-color: var(--primary-purple);
    }

    .btn-wishlist-premium:hover {
        background: var(--primary-purple);
        color: white !important;
    }

    /* Trust Badges */
    .trust-badge-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-top: 30px;
    }

    .trust-card {
        background: #fff;
        padding: 16px;
        border-radius: 16px;
        border: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .trust-card i { font-size: 1.5rem; color: var(--primary-purple); }
    .trust-card span { font-size: 0.85rem; font-weight: 600; color: var(--text-light); }
</style>
@endpush

@section('content')
<div class="container pb-5">
    <div class="breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('catalog.index') }}">Stationery</a></li>
                <li class="breadcrumb-item active">{{ $product->category->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="row g-5">
        <div class="col-lg-6">
            <div class="product-gallery-card">
                <div class="main-img-holder">
                    @if($product->has_discount)
                        <div class="position-absolute top-0 start-0 m-4" style="z-index: 10;">
                            {{-- Warna badge promo disamakan ke ungu aksen --}}
                            <span class="badge rounded-pill px-3 py-2 fw-bold shadow-sm" style="background: var(--primary-purple); color: white;">PROMO {{ $product->discount_percentage }}%</span>
                        </div>
                    @endif
                    <img src="{{ $product->image_url }}" id="main-image" alt="{{ $product->name }}">
                </div>
                
                <div class="d-flex gap-3 justify-content-center overflow-auto py-2">
                    <img src="{{ $product->image_url }}" class="thumb-item active" onclick="changeImage(this)">
                    @foreach($product->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" class="thumb-item" onclick="changeImage(this)">
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="product-details">
                <span class="brand-tag"><i class="bi bi-patch-check-fill me-1"></i> Original Product</span>
                <h1 class="product-title mb-3">{{ $product->name }}</h1>
                
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="d-flex" style="color: #ffc107;">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                    </div>
                    <span class="text-muted small fw-bold">(4.8/5.0 - 120 Terjual)</span>
                </div>

                <div class="price-wrapper">
                    <div class="d-flex flex-column">
                        @if($product->has_discount)
                            <span class="old-price">{{ $product->formatted_original_price }}</span>
                        @endif
                        <span class="current-price">{{ $product->formatted_price }}</span>
                    </div>
                    
                    <hr class="my-4 opacity-50">
                    
                    <div class="d-flex flex-column gap-3">
                        {{-- Form Add To Cart --}}
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="d-flex flex-wrap align-items-center gap-3 mb-2">
                                <div class="qty-control">
                                    <button type="button" class="qty-btn" onclick="decrementQty()"><i class="bi bi-dash-lg"></i></button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="qty-input">
                                    <button type="button" class="qty-btn" onclick="incrementQty()"><i class="bi bi-plus-lg"></i></button>
                                </div>
                                <button type="submit" class="btn btn-cart-premium flex-grow-1" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                    <i class="bi bi-bag-plus-fill fs-5"></i>
                                    <span>{{ $product->stock == 0 ? 'Stok Habis' : 'Masukkan Keranjang' }}</span>
                                </button>
                            </div>
                        </form>

                        {{-- Form Wishlist (Purple Theme) --}}
                        @auth
                        <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-wishlist-premium {{ auth()->user()->hasInWishlist($product) ? 'btn-wishlist-active' : 'btn-wishlist-inactive' }}">
                                <i class="bi {{ auth()->user()->hasInWishlist($product) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                {{ auth()->user()->hasInWishlist($product) ? 'Hapus dari Wishlist' : 'Simpan ke Wishlist' }}
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-wishlist-premium btn-wishlist-inactive">
                            <i class="bi bi-heart"></i> Simpan ke Wishlist
                        </a>
                        @endauth
                    </div>
                </div>

                <div class="mb-5">
                    <h5 class="fw-bold mb-3 d-flex align-items-center">
                        <span class="me-2" style="width: 4px; height: 20px; background: var(--primary-purple); display: inline-block; border-radius: 10px;"></span>
                        Tentang Produk
                    </h5>
                    <p class="text-secondary lh-lg">{{ $product->description }}</p>
                </div>

                <div class="trust-badge-grid">
                    <div class="trust-card">
                        <i class="bi bi-truck"></i>
                        <span>Pengiriman Cepat & Aman</span>
                    </div>
                    <div class="trust-card">
                        <i class="bi bi-shield-check"></i>
                        <span>Garansi Produk 100%</span>
                    </div>
                    <div class="trust-card">
                        <i class="bi bi-arrow-repeat"></i>
                        <span>7 Hari Pengembalian</span>
                    </div>
                    <div class="trust-card">
                        <i class="bi bi-headset"></i>
                        <span>Support CS 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function changeImage(el) {
        const mainImg = document.getElementById('main-image');
        mainImg.style.opacity = '0';
        setTimeout(() => {
            mainImg.src = el.src;
            mainImg.style.opacity = '1';
        }, 200);
        document.querySelectorAll('.thumb-item').forEach(img => img.classList.remove('active'));
        el.classList.add('active');
    }
    function incrementQty() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) < parseInt(input.max)) { input.value = parseInt(input.value) + 1; }
    }
    function decrementQty() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) { input.value = parseInt(input.value) - 1; }
    }
</script>
@endpush
@endsection