@extends('layouts.app')

@section('title', 'Beranda - Modern Steel Blue')

@section('content')

{{-- SWIPER CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --tkp-primary: #60A5FA; /* sky blue */
        --tkp-primary-dark: #1E90FF;
        --tkp-primary-light: #EAF6FF;
        --text-dark: #1a1d23;
        --text-muted: #64748b;
        --bg-body: #ffffff;
    }

    body {
        background-color: var(--bg-body);
        color: var(--text-dark);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ===== HERO BANNER ===== */
    .hero-section {
        padding-top: 24px;
    }

    /* Common section base */
    .section-block {
        padding-top: 28px;
        padding-bottom: 28px;
        border-radius: 14px;
    }

    /* Alternating subtle backgrounds to separate sections */
    .section-block.alt-bg { background: linear-gradient(180deg,#fbfdff,#ffffff); }

    .section-divider { height: 1px; background: rgba(15,23,42,0.04); margin: 18px 0; }

    /* ===== HERO OVERLAY & SEARCH ===== */
    .hero-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 5;
        pointer-events: none;
    }

    .hero-overlay .hero-inner {
        pointer-events: auto;
        max-width: 980px;
        width: 100%;
        padding: 36px 22px;
        text-align: center;
        color: #fff;
        text-shadow: 0 6px 20px rgba(6,10,26,0.32);
    }

    .hero-overlay h1 {
        font-size: 2.1rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .hero-overlay p { margin-bottom: 16px; opacity: 0.95; }

    .search-hero {
        display: flex;
        gap: 8px;
        justify-content: center;
        max-width: 720px;
        margin: 0 auto;
    }

    .search-hero input[type="search"] {
        flex: 1;
        padding: 12px 14px;
        border-radius: 999px;
        border: none;
        box-shadow: 0 6px 18px rgba(3,7,18,0.18);
    }

    .search-hero .btn-search {
        padding: 10px 18px;
        border-radius: 999px;
        background: linear-gradient(90deg,var(--tkp-primary-dark),var(--tkp-primary));
        color: #fff;
        border: none;
    }

    /* Quick floating chat/cart button */
    .fab-quick {
        position: fixed;
        right: 18px;
        bottom: 24px;
        z-index: 9999;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        background: linear-gradient(90deg,#7c3aed,#a78bfa);
        box-shadow: 0 18px 40px rgba(124,58,237,0.18);
        color: #fff;
        border: none;
    }

    .heroSwiper {
        border-radius: 24px;
        height: 370px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.06);
    }

    .hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* ===== CATEGORY: REFRESHED CARD STYLE ===== */
    .category-wrapper {
        text-decoration: none !important;
        display: block;
        width: 100%;
    }

    .category-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        padding: 18px 14px;
        border-radius: 14px;
        background: linear-gradient(180deg, var(--tkp-primary-light), rgba(234,246,255,0.6));
        border: 1px solid rgba(96,165,250,0.10);
        transition: transform 0.28s cubic-bezier(.2,.9,.3,1), box-shadow 0.28s;
        min-height: 170px;
        justify-content: center;
    }

    /* horizontal scroll on small screens */
    .categories-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; padding-bottom: 6px; }
    .categories-scroll .row { flex-wrap: nowrap; }
    .categories-scroll .col { flex: 0 0 auto; width: 160px; }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 40px rgba(96,165,250,0.18);
        border-color: rgba(30,144,255,0.18);
    }

    /* improve icon hover */
    .category-card .category-icon-box { transition: transform 0.36s, box-shadow 0.36s; }
    .category-card:hover .category-icon-box { transform: scale(1.06); box-shadow: 0 20px 40px rgba(96,165,250,0.14); }

    .category-icon-box {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        overflow: hidden;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, rgba(96,165,250,0.12), rgba(96,165,250,0.06));
        box-shadow: 0 8px 20px rgba(96,165,250,0.08);
        border: 2px solid rgba(255,255,255,0.6);
    }

    .category-icon-box img {
        width: 86%;
        height: 86%;
        object-fit: cover;
        border-radius: 50%;
        transition: transform 0.45s ease;
        display: block;
    }

    .category-card:hover .category-icon-box img {
        transform: scale(1.12) rotate(-3deg);
    }

    .meta {
        text-align: center;
    }

    .category-name {
        font-size: 14px;
        font-weight: 800;
        color: var(--tkp-primary-dark);
        margin-top: 6px;
    }

    .category-count {
        font-size: 12px;
        color: rgba(30,64,175,0.85);
        background: transparent;
        margin-top: 4px;
    }

    /* ===== SECTION TITLES ===== */
    .section-title {
        font-weight: 800;
        font-size: 1.6rem;
        letter-spacing: -0.5px;
    }

    .title-line {
        width: 50px;
        height: 4px;
        background: linear-gradient(90deg, var(--tkp-primary-dark), var(--tkp-primary));
        border-radius: 2px;
        margin: 8px auto 0;
    }

    /* ===== Global polish: swiper buttons, section underline animation, product card base ===== */
    .title-line { position: relative; overflow: hidden; }
    .title-line::after {
        content: '';
        position: absolute; inset: 0; left: -100%; background: linear-gradient(90deg, rgba(255,255,255,0.12), rgba(255,255,255,0.02));
        transform: skewX(-18deg);
        animation: shine 2.6s linear infinite;
    }
    @keyframes shine { to { left: 200%; } }

    .swiper-button-next, .swiper-button-prev {
        width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.92); color: var(--tkp-primary-dark); box-shadow: 0 8px 22px rgba(6,10,26,0.12);
        display: grid; place-items: center; --swiper-navigation-size: 16px;
    }
    .swiper-button-next::after, .swiper-button-prev::after { color: var(--tkp-primary-dark); font-size: 18px; }

    /* product-card base style for non-featured items */
    .product-card {
        background: linear-gradient(180deg, #ffffff, #fbfdff);
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(15,23,42,0.04);
    }
    .product-card .card-body a { color: var(--text-dark); }
    .product-card .fw-bold { color: var(--tkp-primary-dark); }

    /* Modern card variants and microinteractions */
    .modern-card { border-radius: 14px; overflow: hidden; position: relative; }
    .modern-card .image-main { transition: transform 0.6s cubic-bezier(.2,.9,.3,1); will-change: transform; }
    .modern-card:hover .image-main { transform: scale(1.06) translateY(-3px); }
    .modern-card .img-gradient-overlay { background: linear-gradient(180deg, rgba(0,0,0,0.0) 20%, rgba(0,0,0,0.28) 100%); opacity: 0.9; }
    .modern-card .card-overlay { position: absolute; left:50%; transform: translateX(-50%) translateY(12px); bottom: 14px; opacity:0; transition: all 0.28s; pointer-events:none; }
    .modern-card:hover .card-overlay { opacity:1; transform: translateX(-50%) translateY(0); pointer-events:auto; }

    .badge-top-left { position: absolute; top: 10px; left: 10px; z-index:13; }
    .badge-top-right { position: absolute; top: 10px; right: 10px; z-index:13; }

    .price-base { font-size: 1rem; color: var(--tkp-primary-dark); }
    .price-sale { font-size: 1.05rem; font-weight: 800; }
    .price-original { font-size: 0.85rem; opacity: 0.85; }

    .product-title { font-size: 0.96rem; font-weight: 700; color: var(--text-dark); }


    /* promo cards polish */
    .promo-card { transition: transform 0.28s, box-shadow 0.28s; }
    .promo-card:hover { transform: translateY(-6px); box-shadow: 0 28px 60px rgba(15,23,42,0.14); }

    .promo-card .promo-content h2 { color: #fff; }
    .promo-card .badge { font-weight:700; }

    /* promo-section layout tweaks */
    .promo-section .promo-card { min-height: 340px; display:flex; align-items:center; }
    .promo-section .promo-content { max-width:56%; }
    .promo-section .promo-img-wrapper, .promo-section .promo-img-wrappers { right: -8px; }

    /* ===== FEATURED CARD: only product boxes use purple gradient ===== */
    .featured-card-wrap .product-card {
        background: linear-gradient(135deg, #7c3aed 8%, #a78bfa 100%);
        border-radius: 12px;
        overflow: hidden;
        border: none;
        color: #fff;
        box-shadow: 0 14px 36px rgba(124,58,237,0.12);
        transition: transform 0.22s, box-shadow 0.22s;
    }

    .featured-card-wrap .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 22px 46px rgba(124,58,237,0.18);
    }

    .featured-card-wrap .product-card .card-body a {
        color: #ffffff !important;
    }

    .featured-card-wrap .product-card .text-muted {
        color: rgba(255,255,255,0.85) !important;
    }

    .featured-card-wrap .product-card p.fw-bold {
        color: #fff !important;
    }

    .featured-card-wrap { display: block; }

    /* ===== Product hover overlay and image glow ===== */
    .product-card .img-wrap { position: relative; border-radius: 10px 10px 0 0; overflow: hidden; }
    .product-card .img-wrap::after {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: linear-gradient(180deg, rgba(255,255,255,0.0), rgba(0,0,0,0.06));
        transition: opacity 0.28s;
    }

    .product-card .card-overlay {
        position: absolute;
        left: 50%;
        transform: translateX(-50%) translateY(12px);
        bottom: 10px;
        z-index: 6;
        opacity: 0;
        pointer-events: none;
        transition: all 0.28s cubic-bezier(.2,.9,.3,1);
    }

    .product-card:hover .card-overlay {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
        pointer-events: auto;
    }

    .product-card .add-to-cart-btn {
        background: linear-gradient(90deg,#7c3aed,#a78bfa);
        border: none;
        color: #fff;
    }

    .product-card .card-body { background: transparent; }

    /* ===== Staggered entrance animation for featured cards ===== */
    @keyframes fadeUp { from {opacity:0; transform: translateY(10px);} to {opacity:1; transform: translateY(0);} }
    .featured-card-wrap { opacity:0; transform: translateY(8px); animation: fadeUp 420ms ease forwards; }
    .product-grid > .featured-card-wrap:nth-child(1) { animation-delay: 80ms; }
    .product-grid > .featured-card-wrap:nth-child(2) { animation-delay: 160ms; }
    .product-grid > .featured-card-wrap:nth-child(3) { animation-delay: 240ms; }
    .product-grid > .featured-card-wrap:nth-child(4) { animation-delay: 320ms; }
    .product-grid > .featured-card-wrap:nth-child(5) { animation-delay: 400ms; }
    .product-grid > .featured-card-wrap:nth-child(6) { animation-delay: 480ms; }

    /* wishlist & rating styles */
    .wishlist-btn { width:36px; height:36px; border-radius:50%; display:grid; place-items:center; padding:0; }
    .wishlist-btn i { color: #e11d48; }

    .rating-badge { font-weight:700; font-size:0.82rem; }

    /* ===== PROMO BANNER WITH IMAGES ===== */
    .promo-card {
        border-radius: 28px;
        border: none;
        overflow: hidden;
        position: relative;
        min-height: 280px;
    }

    .promo-content {
        position: relative;
        z-index: 2;
        max-width: 65%;
    }

    .promo-img-wrapper {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 300px;
        height: auto;
        z-index: 1;
        transition: transform 0.4s ease;
    }
    .promo-img-wrappers{
        position: absolute;
        bottom: 0;
        right: 0;
        width: 200px;
        height: auto;
        z-index: 1;
        transition: transform 0.4s ease;
    }

    .promo-card:hover .promo-img-wrapper {
        transform: scale(1.1) rotate(-5deg);
    }

    .btn-promo {
        background: #ffffff;
        color: var(--text-dark);
        font-weight: 700;
        padding: 12px 30px;
        border-radius: 14px;
        text-decoration: none;
        display: inline-block;
        transition: 0.3s;
        border: none;
    }

    .btn-promo:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        background: #f8fafc;
    }

    /* ===== PRODUCT GRID ===== */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    /* ===== Extra polish ===== */
    /* Swiper pagination bullets */
    .swiper-pagination-bullet {
        width: 10px; height: 10px; opacity: 1; background: rgba(255,255,255,0.65);
        border: 2px solid rgba(15,23,42,0.06); transition: transform 0.28s, background 0.28s, box-shadow 0.28s;
    }
    .swiper-pagination-bullet-active {
        transform: scale(1.45);
        background: linear-gradient(90deg,var(--tkp-primary-dark),var(--tkp-primary));
        box-shadow: 0 8px 24px rgba(96,165,250,0.18);
        border-color: transparent;
    }

    /* search glass effect */
    .search-hero input[type="search"] {
        backdrop-filter: blur(6px) saturate(120%);
        background: rgba(255,255,255,0.72);
        border: 1px solid rgba(15,23,42,0.04);
        transition: box-shadow 0.22s, transform 0.18s;
    }
    .search-hero input[type="search"]:focus { box-shadow: 0 10px 30px rgba(6,10,26,0.12); transform: translateY(-1px); outline: none; }
    .search-hero .btn-search { transition: transform 0.18s, box-shadow 0.18s; }
    .search-hero .btn-search:hover { transform: translateY(-3px); box-shadow: 0 14px 30px rgba(30,64,175,0.12); }

    /* wishlist hover */
    .wishlist-btn { background: rgba(255,255,255,0.9); transition: transform 0.18s, box-shadow 0.18s; }
    .wishlist-btn:hover { transform: scale(1.06); box-shadow: 0 10px 26px rgba(15,23,42,0.12); }

    /* card overlay button polish */
    .card-overlay .btn { border-radius: 999px; padding: 6px 12px; }

    /* reduce spacing on small screens */
    @media (max-width: 576px) {
        .hero-overlay .hero-inner { padding: 22px 12px; }
        .category-card { min-height: 150px; padding: 12px; }
        .categories-scroll .col { width: 140px; }
    }

    @media (min-width: 768px) {
        .product-grid { grid-template-columns: repeat(4, 1fr); }
    }

    @media (min-width: 1200px) {
        .product-grid { grid-template-columns: repeat(5, 1fr); }
    }

    .btn-see-all {
        color: var(--tkp-primary);
        font-weight: 700;
        text-decoration: none;
        font-size: 15px;
    }

    /* ===== NEW SECTION (Baru di Katalog) ===== */
    .new-section .section-sub {
        display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
    }

    .filter-chips { display:flex; gap:8px; align-items:center; }
    .filter-chips .chip { padding:6px 12px; border-radius:999px; background: rgba(15,23,42,0.04); color: var(--text-dark); border:1px solid rgba(15,23,42,0.04); font-weight:600; cursor:pointer; }
    .filter-chips .chip.active { background: linear-gradient(90deg,var(--tkp-primary-dark),var(--tkp-primary)); color:#fff; box-shadow:0 10px 28px rgba(96,165,250,0.12); }

    .new-card-wrap { position: relative; }
        .new-badge { background: linear-gradient(90deg,#7c3aed,#a78bfa); color: #fff; font-weight:700; padding:6px 10px; border-radius:999px; font-size:0.78rem; position: absolute; right: 12px; bottom: 12px; z-index:9; box-shadow: 0 8px 20px rgba(124,58,237,0.12); }

    .new-card-wrap .product-card { border: none; box-shadow: 0 12px 30px rgba(6,10,26,0.06); background: linear-gradient(180deg,#ffffff,#f7fbff); border-radius:14px; }
    .new-card-wrap .product-card .card-body { padding: 14px; }

    /* ensure discount badge remains visible above overlays */
    .new-card-wrap .badge.bg-danger { z-index: 12; position: absolute; top: 10px; left: 12px; }

    /* subtle hover to lift the new cards */
    .new-card-wrap .product-card:hover { transform: translateY(-8px); box-shadow: 0 26px 56px rgba(6,10,26,0.12); }
</style>

<div class="container-fluid px-lg-5">
    
    {{-- 1. HERO BANNER --}}
    <section class="hero-section mb-5" style="position:relative;">
        <div class="swiper heroSwiper shadow">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="https://images.unsplash.com/photo-1452860606245-08befc0ff44b?q=80&w=2000&h=500&auto=format&fit=crop" class="hero-img">
                </div>
                <div class="swiper-slide">
                    <a href="{{ route('catalog.index') }}">
                        <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?q=80&w=2000&h=500&auto=format&fit=crop" class="hero-img">
                    </a>
                </div>
               <div class="swiper-slide">
                    <img src="images/alat.png" class="hero-img">
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="hero-overlay">
            <div class="hero-inner">
                <h1>Beli Perlengkapan Sekolah, Lebih Cepat & Mudah</h1>
                <p class="mb-3">Temukan alat tulis dan kebutuhan sekolah berkualitas dengan harga ramah kantong.</p>
                <div class="search-hero">
                    <input type="search" placeholder="Cari produk, mis. pensil, buku, tas" aria-label="search">
                    <button class="btn-search">Cari</button>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. KATEGORI PILIHAN (BULAT FULL) --}}
    <section class="mb-5 pb-4 category-section section-block alt-bg">
        <div class="text-center mb-5">
            <h4 class="section-title mb-0">Kategori Pilihan</h4>
            <div class="title-line"></div>
        </div>
        <div class="categories-scroll">
            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-5 justify-content-center text-center">
            @foreach($categories as $category)
                <div class="col">
                    <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="category-wrapper">
                        <div class="category-card">
                            <div class="category-icon-box">
                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}">
                            </div>
                            <div class="meta w-100">
                                <div class="category-name text-truncate">{{ $category->name }}</div>
                                <div class="category-count">{{ $category->products_count }} Item</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
        </div>
    </section>

    {{-- 3. PRODUK UNGGULAN --}}
    <section class="mb-5 py-5 featured-section section-block" style="margin: 0 -3rem;">
        <div class="container-fluid px-lg-5" style="padding:3rem;">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h4 class="section-title mb-0">Produk Unggulan</h4>
                    <p class="text-muted small mt-2">Koleksi terbaik yang paling banyak dicari minggu ini.</p>
                </div>
                <a href="{{ route('catalog.index') }}" class="btn-see-all">Lihat Semua Katalog <i class="bi bi-arrow-right"></i></a>
            </div>

            <div class="product-grid">
                @foreach($featuredProducts as $product)
                    <div class="featured-card-wrap">
                        @include('components.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 4. PROMO BANNER DENGAN GAMBAR --}}
    <section class="mb-5 py-4 promo-section section-block alt-bg">
        <div class="row g-4">
            {{-- Flash Sale --}}
            <div class="col-md-6">
                <div class="promo-card p-5 h-100 text-white shadow" style="background: linear-gradient(135deg, #FFB700 0%, #FF8000 100%);">
                    <div class="promo-content">
                        <span class="badge bg-white text-dark mb-3 px-3 shadow-sm">Flash Sale</span>
                        <h2 class="fw-bold mb-3">Diskon Seru Hari Ini!</h2>
                        <p class="fs-5 opacity-90">Potongan harga hingga <span class="fw-bold">70%</span> tanpa minimum belanja.</p>
                        <div class="mt-4">
                            <a href="#" class="btn-promo">Belanja Sekarang</a>
                        </div>
                    </div>
                    <img src="images/api.png" class="promo-img-wrappers" alt="Flash Sale Illustration">
                </div>
            </div>

            {{-- Voucher --}}
            <div class="col-md-6">
                <div class="promo-card p-5 h-100 text-white shadow" style="background: linear-gradient(135deg, #3B6181 0%, #5a8bb5 100%);">
                    <div class="promo-content">
                        <span class="badge bg-white text-dark mb-3 px-3 shadow-sm">New User</span>
                        <h2 class="fw-bold mb-3">Voucher Belanja</h2>
                        <p class="fs-5 opacity-90">Gunakan kode promo spesial:<br><strong class="fs-3 text-warning">BARUUNTUNG</strong></p>
                        <div class="mt-4">
                            <a href="{{ route('register') }}" class="btn-promo text-info">Klaim Voucher</a>
                        </div>
                    </div>
                    <img src="images/promo.png" class="promo-img-wrapper" alt="Voucher Illustration">
                </div>
            </div>
        </div>
    </section>

    {{-- 5. PRODUK TERBARU --}}
    <section class="mb-5 new-section section-block">
        <div class="d-flex justify-content-between align-items-end mb-3">
            <div>
                <h4 class="section-title mb-0">Baru di Katalog</h4>
                <p class="text-muted small mt-2">Update stok terbaru setiap harinya.</p>
                <div class="section-sub mt-3">
                    
                </div>
            </div>
            <a href="{{ route('catalog.index') }}" class="btn-see-all">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="product-grid">
            @foreach($latestProducts as $product)
                <div class="new-card-wrap">
                    @include('components.product-card', ['product' => $product, 'variant' => 'new'])
                </div>
            @endforeach
        </div>
    </section>
</div>

{{-- SWIPER JS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper(".heroSwiper", {
            loop: true,
            speed: 1000,
            autoplay: { delay: 5000, disableOnInteraction: false },
            pagination: { el: ".swiper-pagination", clickable: true, dynamicBullets: true },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        });
    });
</script>
@endsection