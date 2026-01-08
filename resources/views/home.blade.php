@extends('layouts.app')

@section('title', 'Beranda - Modern Steel Blue')

@section('content')

{{-- SWIPER CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --tkp-primary: #60A5FA;
        --tkp-primary-dark: #1E90FF;
        --tkp-primary-light: #EAF6FF;
        --text-dark: #1a1d23;
        --text-muted: #64748b;
        --bg-body: #ffffff;
        --transition-smooth: all 0.3s cubic-bezier(.2,.9,.3,1);
    }

    body {
        background-color: var(--bg-body);
        color: var(--text-dark);
        font-family: 'Plus Jakarta Sans', sans-serif;
        scroll-behavior: smooth;
    }

    /* ===== HERO BANNER ===== */
    .hero-section {
        padding-top: 24px;
    }

    .section-block {
        padding-top: 28px;
        padding-bottom: 28px;
        border-radius: 14px;
    }

    .section-block.alt-bg { 
        background: linear-gradient(180deg,#fbfdff,#ffffff); 
    }

    .section-divider { 
        height: 1px; 
        background: rgba(15,23,42,0.04); 
        margin: 18px 0; 
    }

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
        animation: slideUp 0.8s ease forwards;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .hero-overlay h1 {
        font-size: 2.1rem;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -1px;
    }

    .hero-overlay p { 
        margin-bottom: 16px; 
        opacity: 0.95;
        font-size: 1.05rem;
    }

    .search-hero {
        display: flex;
        gap: 8px;
        justify-content: center;
        max-width: 720px;
        margin: 0 auto;
        animation: slideUp 0.8s ease 0.2s forwards;
        opacity: 0;
    }

    .search-hero input[type="search"] {
        flex: 1;
        padding: 14px 18px;
        border-radius: 999px;
        border: none;
        box-shadow: 0 6px 18px rgba(3,7,18,0.18);
        backdrop-filter: blur(8px);
        background: rgba(255,255,255,0.85);
        font-size: 0.95rem;
        transition: var(--transition-smooth);
    }

    .search-hero input[type="search"]:focus {
        outline: none;
        box-shadow: 0 12px 32px rgba(3,7,18,0.25);
        transform: translateY(-2px);
        background: rgba(255,255,255,0.95);
    }

    .search-hero .btn-search {
        padding: 12px 28px;
        border-radius: 999px;
        background: linear-gradient(90deg,var(--tkp-primary-dark),var(--tkp-primary));
        color: #fff;
        border: none;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition-smooth);
    }

    .search-hero .btn-search:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(30,144,255,0.25);
    }

    .heroSwiper {
        border-radius: 24px;
        height: 370px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.06);
        overflow: hidden;
    }

    .hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

/* ===========================
    KATEGORI PILIHAN (GLOWING PURPLE)
=========================== */
:root {
    --glow-purple: #a855f7;
    --dark-purple: #6b21a8;
    --bg-purple: #faf5ff;
}

.categories-scroll {
    overflow-x: auto;
    padding: 20px 10px;
    scrollbar-width: none; /* Sembunyikan scrollbar Firefox */
}

.categories-scroll::-webkit-scrollbar {
    display: none; /* Sembunyikan scrollbar Chrome/Safari */
}

.categories-scroll .row {
    flex-wrap: nowrap;
    margin-bottom: 10px;
}

.categories-scroll .col {
    flex: 0 0 auto;
    width: 210px; /* Diperbesar sedikit dari 190px */
}

.category-wrapper {
    text-decoration: none !important;
    display: block;
}

.category-card {
    background: #ffffff;
    border-radius: 24px; /* Lebih bulat */
    padding: 30px 20px;
    min-height: 240px; /* Lebih tinggi & luas */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 16px;
    border: 1px solid rgba(168, 85, 247, 0.1);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
}

/* Efek Background Gradient Halus saat Hover */
.category-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(180deg, rgba(168, 85, 247, 0.05) 0%, #fff 100%);
    z-index: 0;
}

.category-card:hover {
    transform: translateY(-12px);
    border-color: var(--glow-purple);
    box-shadow: 0 20px 40px rgba(168, 85, 247, 0.25);
}

.category-icon-box {
    width: 120px; /* Diperbesar */
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f3e8ff, #ffffff);
    display: grid;
    place-items: center;
    position: relative;
    z-index: 1;
    border: 4px solid #fff;
    box-shadow: 0 8px 20px rgba(168, 85, 247, 0.15);
    transition: all 0.4s ease;
}

.category-card:hover .category-icon-box {
    transform: rotate(5deg) scale(1.1);
    box-shadow: 0 0 30px rgba(168, 85, 247, 0.4);
    background: linear-gradient(135deg, var(--glow-purple), var(--dark-purple));
}

.category-icon-box img {
    width: 85%;
    height: 85%;
    object-fit: cover;
    border-radius: 50%;
    transition: all 0.4s ease;
}

.category-card:hover .category-icon-box img {
    filter: brightness(1.1);
}

.category-name {
   .category-name {
    font-size: 17px;            /* ⬅️ lebih gede */
    font-weight: 900;           /* ⬅️ super tebel */
    color: var(--tkp-primary-dark);
    text-align: center;
    line-height: 1.25;
    letter-spacing: -0.2px;

    /* tetap rapi walau panjang */
    display: -webkit-box;
    -webkit-line-clamp: 2;      /* max 2 baris */
    -webkit-box-orient: vertical;
    overflow: hidden;

    min-height: 44px;           /* jaga tinggi card konsisten */
}
}

.category-card:hover .category-name {
    color: var(--dark-purple);
}

.category-count {
    position: relative;
    z-index: 1;
    font-size: 14px;
    background: rgba(168, 85, 247, 0.1);
    color: var(--dark-purple);
    padding: 4px 14px;
    border-radius: 20px;
    font-weight: 700;
    transition: all 0.3s ease;
}

.category-card:hover .category-count {
    background: var(--glow-purple);
    color: #fff;
}

/* Responsive Optimization */
@media (max-width: 576px) {
    .categories-scroll .col {
        width: 180px;
    }
    .category-card {
        min-height: 210px;
        padding: 20px 15px;
    }
    .category-icon-box {
        width: 100px;
        height: 100px;
    }
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
        position: relative;
        overflow: hidden;
    }
    
    .title-line::after {
        content: '';
        position: absolute;
        inset: 0;
        left: -100%;
        background: linear-gradient(90deg, rgba(255,255,255,0.12), rgba(255,255,255,0.02));
        transform: skewX(-18deg);
        animation: shine 2.6s linear infinite;
    }
    
    @keyframes shine { to { left: 200%; } }

    .swiper-button-next, .swiper-button-prev {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255,255,255,0.92);
        color: var(--tkp-primary-dark);
        box-shadow: 0 8px 22px rgba(6,10,26,0.12);
        display: grid;
        place-items: center;
        --swiper-navigation-size: 16px;
        transition: var(--transition-smooth);
    }

    .swiper-button-next:hover, .swiper-button-prev:hover {
        background: #fff;
        transform: scale(1.08);
        box-shadow: 0 12px 30px rgba(6,10,26,0.18);
    }

    .swiper-button-next::after, .swiper-button-prev::after { 
        color: var(--tkp-primary-dark); 
        font-size: 18px; 
    }

    /* product-card base style */
    .product-card {
        background: linear-gradient(180deg, #ffffff, #fbfdff);
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(15,23,42,0.04);
        transition: var(--transition-smooth);
    }

    .product-card .card-body a { color: var(--text-dark); }
    .product-card .fw-bold { color: var(--tkp-primary-dark); }

    .price-base { font-size: 1rem; color: var(--tkp-primary-dark); }
    .price-sale { font-size: 1.05rem; font-weight: 800; }
    .price-original { font-size: 0.85rem; opacity: 0.85; }

    .product-title { font-size: 0.96rem; font-weight: 700; color: var(--text-dark); }

    /* ===== FEATURED CARD ===== */
    .featured-card-wrap .product-card {
        background: linear-gradient(135deg, #7c3aed 8%, #a78bfa 100%);
        border-radius: 12px;
        overflow: hidden;
        border: none;
        color: #fff;
        box-shadow: 0 14px 36px rgba(124,58,237,0.12);
        transition: var(--transition-smooth);
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

    /* Product hover overlay */
    .product-card .img-wrap { 
        position: relative; 
        border-radius: 10px 10px 0 0; 
        overflow: hidden; 
    }

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
        transition: var(--transition-smooth);
    }

    .product-card .add-to-cart-btn:hover {
        transform: scale(1.05);
    }

    .product-card .card-body { background: transparent; }

    /* ===== Staggered entrance animation ===== */
    @keyframes fadeUp { 
        from {opacity:0; transform: translateY(10px);} 
        to {opacity:1; transform: translateY(0);} 
    }

    .featured-card-wrap { 
        opacity:0; 
        transform: translateY(8px); 
        animation: fadeUp 420ms ease forwards; 
    }

    .product-grid > .featured-card-wrap:nth-child(1) { animation-delay: 80ms; }
    .product-grid > .featured-card-wrap:nth-child(2) { animation-delay: 160ms; }
    .product-grid > .featured-card-wrap:nth-child(3) { animation-delay: 240ms; }
    .product-grid > .featured-card-wrap:nth-child(4) { animation-delay: 320ms; }
    .product-grid > .featured-card-wrap:nth-child(5) { animation-delay: 400ms; }
    .product-grid > .featured-card-wrap:nth-child(6) { animation-delay: 480ms; }

    /* wishlist & rating */
    .wishlist-btn { 
        width:36px; 
        height:36px; 
        border-radius:50%; 
        display:grid; 
        place-items:center; 
        padding:0;
        background: rgba(255,255,255,0.9);
        transition: var(--transition-smooth);
        border: none;
    }

    .wishlist-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 10px 26px rgba(15,23,42,0.12);
    }

    .wishlist-btn i { color: #e11d48; }

    .rating-badge { 
        font-weight:700; 
        font-size:0.82rem; 
    }

    /* ===== PROMO BANNER (ENHANCED) ===== */
    .promo-card {
        border-radius: 28px;
        border: none;
        overflow: hidden;
        position: relative;
        min-height: 280px;
        transition: var(--transition-smooth);
    }

    .promo-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1), transparent);
        pointer-events: none;
        z-index: 1;
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
        transition: var(--transition-smooth);
    }

    .promo-img-wrappers{
        position: absolute;
        bottom: 0;
        right: 0;
        width: 200px;
        height: auto;
        z-index: 1;
        transition: var(--transition-smooth);
    }

    .promo-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 28px 60px rgba(15,23,42,0.14);
    }

    .promo-card:hover .promo-img-wrapper {
        transform: scale(1.12) rotate(-5deg);
    }

    .btn-promo {
        background: #ffffff;
        color: var(--text-dark);
        font-weight: 700;
        padding: 12px 30px;
        border-radius: 14px;
        text-decoration: none;
        display: inline-block;
        transition: var(--transition-smooth);
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

    /* Swiper pagination */
    .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        opacity: 1;
        background: rgba(255,255,255,0.65);
        border: 2px solid rgba(15,23,42,0.06);
        transition: var(--transition-smooth);
    }

    .swiper-pagination-bullet-active {
        transform: scale(1.45);
        background: linear-gradient(90deg,var(--tkp-primary-dark),var(--tkp-primary));
        box-shadow: 0 8px 24px rgba(96,165,250,0.18);
        border-color: transparent;
    }

    /* ===== NEW CARD WRAP ===== */
    .new-card-wrap { 
        position: relative; 
    }

    .new-badge { 
        background: linear-gradient(90deg,#7c3aed,#a78bfa); 
        color: #fff; 
        font-weight:700; 
        padding:6px 10px; 
        border-radius:999px; 
        font-size:0.78rem; 
        position: absolute; 
        right: 12px; 
        bottom: 12px; 
        z-index:9; 
        box-shadow: 0 8px 20px rgba(124,58,237,0.12); 
    }

    .new-card-wrap .product-card { 
        border: none; 
        box-shadow: 0 12px 30px rgba(6,10,26,0.06); 
        background: linear-gradient(180deg,#ffffff,#f7fbff); 
        border-radius:14px; 
        transition: var(--transition-smooth);
    }

    .new-card-wrap .product-card .card-body { 
        padding: 14px; 
    }

    .new-card-wrap .badge.bg-danger { 
        z-index: 12; 
        position: absolute; 
        top: 10px; 
        left: 12px; 
    }

    .new-card-wrap .product-card:hover { 
        transform: translateY(-8px); 
        box-shadow: 0 26px 56px rgba(6,10,26,0.12); 
    }

    .btn-see-all {
        color: var(--tkp-primary);
        font-weight: 700;
        text-decoration: none;
        font-size: 15px;
        transition: var(--transition-smooth);
    }

    .btn-see-all:hover {
        color: var(--tkp-primary-dark);
        transform: translateX(4px);
    }

    /* ===== TRUST SECTION (NEW) ===== */
    .trust-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 28px;
        padding: 60px 40px;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .trust-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="rgba(255,255,255,0.08)"><circle cx="30" cy="30" r="30"/></g></g></svg>');
        opacity: 0.6;
    }

    .trust-content {
        position: relative;
        z-index: 2;
    }

    .trust-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .trust-item {
        text-align: center;
        animation: fadeUp 0.6s ease forwards;
        opacity: 0;
    }

    .trust-item:nth-child(1) { animation-delay: 0.1s; }
    .trust-item:nth-child(2) { animation-delay: 0.2s; }
    .trust-item:nth-child(3) { animation-delay: 0.3s; }
    .trust-item:nth-child(4) { animation-delay: 0.4s; }

    .trust-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: rgba(255,255,255,0.15);
        border-radius: 50%;
        display: grid;
        place-items: center;
        font-size: 40px;
        transition: var(--transition-smooth);
    }

    .trust-item:hover .trust-icon {
        transform: scale(1.15) rotate(10deg);
        background: rgba(255,255,255,0.25);
    }

    .trust-number {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .trust-text {
        font-size: 0.95rem;
        opacity: 0.95;
    }

    /* ===== FEATURED CATEGORY SECTION (NEW) ===== */
    .featured-category-section {
        margin-bottom: 60px;
    }

    .category-showcase {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
    }

    .category-hero {
        position: relative;
        border-radius: 20px;
        height: 300px;
        overflow: hidden;
        cursor: pointer;
        group: 'cat';
    }

    .category-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0,0,0,0.2), rgba(0,0,0,0.5));
        z-index: 2;
        transition: var(--transition-smooth);
    }

    .category-hero:hover::before {
        background: linear-gradient(135deg, rgba(0,0,0,0.1), rgba(0,0,0,0.35));
    }

    .category-hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition-smooth);
    }

    .category-hero:hover .category-hero-img {
        transform: scale(1.08);
    }

    .category-hero-content {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 30px;
        z-index: 3;
        color: #fff;
    }

    .category-hero-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .category-hero-subtitle {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 16px;
    }

    .category-hero-btn {
        background: #fff;
        color: var(--text-dark);
        padding: 10px 20px;
        border-radius: 999px;
        border: none;
        font-weight: 700;
        cursor: pointer;
        display: inline-block;
        width: fit-content;
        transition: var(--transition-smooth);
    }

    .category-hero-btn:hover {
        transform: translateX(4px);
        box-shadow: 0 10px 24px rgba(0,0,0,0.2);
    }

    /* ===== STATS COUNTER (NEW) ===== */
    .stats-section {
        background: linear-gradient(180deg, #f8f9ff, #ffffff);
        border-radius: 20px;
        padding: 50px 30px;
        margin: 60px 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 30px;
        text-align: center;
    }

    .stat-card {
        padding: 30px 20px;
        background: #fff;
        border-radius: 16px;
        border: 1px solid rgba(15,23,42,0.06);
        transition: var(--transition-smooth);
        box-shadow: 0 4px 12px rgba(15,23,42,0.04);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 32px rgba(15,23,42,0.12);
        border-color: var(--tkp-primary-light);
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 12px;
        background: linear-gradient(90deg, var(--tkp-primary-dark), var(--tkp-primary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 0.85rem;
        color: var(--text-muted);
        font-weight: 600;
    }

    /* ===== TESTIMONIAL SECTION (NEW) ===== */
    .testimonial-section {
        margin: 60px 0;
    }

    .testimonial-swiper {
        padding: 40px 0;
    }

    .testimonial-card {
        background: linear-gradient(180deg, #ffffff, #f7fbff);
        border-radius: 16px;
        padding: 30px;
        border: 1px solid rgba(15,23,42,0.06);
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 8px 20px rgba(15,23,42,0.04);
        transition: var(--transition-smooth);
    }

    .testimonial-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(15,23,42,0.12);
    }

    .testimonial-stars {
        color: #FFD700;
        margin-bottom: 12px;
    }

    .testimonial-text {
        flex-grow: 1;
        margin-bottom: 20px;
        font-size: 0.95rem;
        line-height: 1.6;
        color: var(--text-dark);
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .testimonial-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--tkp-primary), var(--tkp-primary-dark));
        display: grid;
        place-items: center;
        color: #fff;
        font-weight: 700;
    }

    .testimonial-name {
        font-weight: 700;
        color: var(--text-dark);
    }

    .testimonial-role {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    /* Responsive */
    @media (max-width: 576px) {
        .hero-overlay .hero-inner { 
            padding: 22px 12px; 
        }

        .hero-overlay h1 {
            font-size: 1.6rem;
        }

        .category-card { 
            min-height: 150px; 
            padding: 12px; 
        }

        .categories-scroll .col { 
            width: 140px; 
        }

        .product-grid { 
            gap: 14px; 
        }

        .promo-section .promo-card {
            min-height: 280px;
        }

        .promo-content {
            max-width: 100%;
        }

        .promo-img-wrapper,
        .promo-img-wrappers {
            display: none;
        }

        .section-title {
            font-size: 1.3rem;
        }

        .trust-section {
            padding: 40px 20px;
        }

        .trust-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }

        .trust-icon {
            width: 60px;
            height: 60px;
            font-size: 30px;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .category-showcase {
            grid-template-columns: 1fr;
        }
    }

    @media (min-width: 768px) {
        .product-grid { 
            grid-template-columns: repeat(4, 1fr); 
        }
    }

    @media (min-width: 1200px) {
        .product-grid { 
            grid-template-columns: repeat(5, 1fr); 
        }
    }
</style>

<div class="container-fluid px-lg-5">
    
    {{-- 1. HERO BANNER --}}
    <section class="hero-section mb-5" style="position:relative;">
        <div class="swiper heroSwiper shadow">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="https://images.unsplash.com/photo-1452860606245-08befc0ff44b?q=80&w=2000&h=500&auto=format&fit=crop" class="hero-img" alt="Banner 1">
                </div>
                <div class="swiper-slide">
                    <a href="{{ route('catalog.index') }}">
                        <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?q=80&w=2000&h=500&auto=format&fit=crop" class="hero-img" alt="Banner 2">
                    </a>
                </div>
               <div class="swiper-slide">
                    <img src="images/alat.png" class="hero-img" alt="Banner 3">
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

    {{-- 2. KATEGORI PILIHAN --}}
   <section class="mb-5 py-5 section-block" style="background-color: var(--bg-purple);">
    <div class="container-fluid">
        <div class="text-center mb-5">
            <h4 class="section-title mb-0" style="color: var(--dark-purple); font-weight: 850; letter-spacing: -0.5px;">Kategori Pilihan</h4>
            <div class="title-line" style="background: linear-gradient(90deg, transparent, var(--glow-purple), transparent); height: 4px; width: 80px; margin: 15px auto; border-radius: 10px;"></div>
        </div>

        <div class="categories-scroll">
            <div class="row g-4 justify-content-start justify-content-md-center text-center">
                @foreach($categories as $category)
                    <div class="col">
                        <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="category-wrapper">
                            <div class="category-card">
                                <div class="category-icon-box">
                                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}">
                                </div>
                                <div class="category-name text-truncate">
                                    {{ $category->name }}
                                </div>
                                <div class="category-count">
                                    {{ $category->products_count }} Item
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

    {{-- 3. STATS SECTION --}}
    <section class="stats-section">
        <div class="text-center mb-5">
            <h4 class="section-title mb-0">Kepercayaan Jutaan Pelanggan</h4>
            <div class="title-line"></div>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📦</div>
                <div class="stat-number">50K+</div>
                <div class="stat-label">Produk Tersedia</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⭐</div>
                <div class="stat-number">4.8/5</div>
                <div class="stat-label">Rating Pelanggan</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🚚</div>
                <div class="stat-number">24 Jam</div>
                <div class="stat-label">Pengiriman Cepat</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💯</div>
                <div class="stat-number">100%</div>
                <div class="stat-label">Aman & Terpercaya</div>
            </div>
        </div>
    </section>

    {{-- 4. PRODUK UNGGULAN --}}
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

    {{-- 5. FEATURED CATEGORY SHOWCASE --}}
    <section class="featured-category-section">
        <div class="text-center mb-5">
            <h4 class="section-title mb-0">Kategori Unggulan</h4>
            <div class="title-line"></div>
        </div>
        <div class="category-showcase">
            <div class="category-hero">
                <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=600&auto=format&fit=crop" class="category-hero-img" alt="Alat Tulis">
                <div class="category-hero-content">
                    <div class="category-hero-title">Alat Tulis</div>
                    <div class="category-hero-subtitle">2,500+ Produk</div>
                    <a href="#" class="category-hero-btn">Jelajahi</a>
                </div>
            </div>
            <div class="category-hero">
                <img src="https://images.unsplash.com/photo-1507842217343-583f7270bfba?q=80&w=600&auto=format&fit=crop" class="category-hero-img" alt="Buku & Kertas">
                <div class="category-hero-content">
                    <div class="category-hero-title">Buku & Kertas</div>
                    <div class="category-hero-subtitle">1,800+ Produk</div>
                    <a href="#" class="category-hero-btn">Jelajahi</a>
                </div>
            </div>
            <div class="category-hero">
                <img src="https://images.unsplash.com/photo-1609902726285-97c3997ef1dd?q=80&w=600&auto=format&fit=crop" class="category-hero-img" alt="Tas & Aksesori">
                <div class="category-hero-content">
                    <div class="category-hero-title">Tas & Aksesori</div>
                    <div class="category-hero-subtitle">1,200+ Produk</div>
                    <a href="#" class="category-hero-btn">Jelajahi</a>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. PROMO BANNER --}}
    <section class="mb-5 py-4 promo-section section-block alt-bg">
        <div class="row g-4">
            {{-- Flash Sale --}}
            <div class="col-md-6">
                <div class="promo-card p-5 h-100 text-white shadow" style="background: linear-gradient(135deg, #FFB700 0%, #FF8000 100%);">
                    <div class="promo-content">
                        <span class="badge bg-white text-dark mb-3 px-3 shadow-sm">⚡ Flash Sale</span>
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
                        <span class="badge bg-white text-dark mb-3 px-3 shadow-sm">🎉 New User</span>
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

    {{-- 7. TRUST & BENEFITS SECTION --}}
    <section class="trust-section">
        <div class="trust-content">
            <div class="text-center mb-5">
                <h3 class="fw-bold mb-2" style="font-size: 2rem;">Mengapa Memilih Kami?</h3>
                <p style="opacity: 0.95;">Kami berkomitmen memberikan pengalaman berbelanja terbaik untuk Anda</p>
            </div>
            <div class="trust-grid">
                <div class="trust-item">
                    <div class="trust-icon">✓</div>
                    <div class="trust-number">100% Asli</div>
                    <div class="trust-text">Semua produk dijamin asli dan bergaransi resmi</div>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">🎁</div>
                    <div class="trust-number">Gratis Ongkir</div>
                    <div class="trust-text">Bebas ongkir untuk pembelian di atas Rp 50k</div>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">↩️</div>
                    <div class="trust-number">Mudah Retur</div>
                    <div class="trust-text">Garansi uang kembali 100% jika tidak puas</div>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">📞</div>
                    <div class="trust-number">CS 24/7</div>
                    <div class="trust-text">Tim support siap membantu kapan saja</div>
                </div>
            </div>
        </div>
    </section>

    {{-- 8. TESTIMONIAL SECTION --}}
    <section class="testimonial-section">
        <div class="text-center mb-5">
            <h4 class="section-title mb-0">Testimoni Pelanggan</h4>
            <div class="title-line"></div>
        </div>
        <div class="swiper testimonialSwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">"Produk berkualitas dan pengiriman cepat! Saya sangat puas dengan layanan ini. Pasti akan belanja lagi."</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">AN</div>
                            <div>
                                <div class="testimonial-name">Aisyah Nur</div>
                                <div class="testimonial-role">Pembeli Terverifikasi</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">"Harga sangat kompetitif dan ada banyak pilihan. Customer service-nya juga responsif dan helpful!"</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">RM</div>
                            <div>
                                <div class="testimonial-name">Reza Maulana</div>
                                <div class="testimonial-role">Pembeli Terverifikasi</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">"Belanja alat tulis jadi lebih mudah. Semua yang saya cari ada dan harganya masuk akal. Recommended!"</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">SD</div>
                            <div>
                                <div class="testimonial-name">Siti Dewi</div>
                                <div class="testimonial-role">Pembeli Terverifikasi</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">"Sangat memuaskan! Packaging rapi, produk sesuai dengan foto, dan proses checkout sangat simpel."</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">AW</div>
                            <div>
                                <div class="testimonial-name">Ahmad Wijaya</div>
                                <div class="testimonial-role">Pembeli Terverifikasi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    {{-- 9. PRODUK TERBARU --}}
    <section class="mb-5 new-section section-block">
        <div class="d-flex justify-content-between align-items-end mb-3">
            <div>
                <h4 class="section-title mb-0">Baru di Katalog</h4>
                <p class="text-muted small mt-2">Update stok terbaru setiap harinya.</p>
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
        // Hero Swiper
        new Swiper(".heroSwiper", {
            loop: true,
            speed: 1000,
            autoplay: { delay: 5000, disableOnInteraction: false },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            effect: 'fade',
            fadeEffect: { crossFade: true }
        });

        // Testimonial Swiper
        new Swiper(".testimonialSwiper", {
            loop: true,
            speed: 500,
            autoplay: { delay: 6000, disableOnInteraction: false },
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            breakpoints: {
                768: { slidesPerView: 2 },
                1200: { slidesPerView: 3 }
            }
        });
    });
</script>
@endsection