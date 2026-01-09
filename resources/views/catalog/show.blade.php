@extends('layouts.app')

@section('title', 'Katalog Sepatu')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
    :root {
        --primary: #9333ea;
        --primary-light: #c084fc;
        --primary-dark: #7c3aed;
        --primary-glow: rgba(147, 51, 234, 0.4);
        --bg: linear-gradient(135deg, #f3e8ff, #fae8ff);
        --card-bg: rgba(255, 255, 255, 0.65);
        --text: #581c87;
        --text-muted: #a78bfa;
        --border: rgba(147, 51, 234, 0.25);
        --shadow: 0 12px 40px rgba(147, 51, 234, 0.15);
        --transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    body {
        background: var(--bg);
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text);
    }

    /* Hero Section */
    .hero-catalog {
        height: 70vh;
        min-height: 500px;
        background: linear-gradient(rgba(147, 51, 234, 0.3), rgba(147, 51, 234, 0.5)), url('https://images.unsplash.com/photo-1605348532760-6753d2c43387?q=80&w=1920') center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        border-radius: 0 0 40px 40px;
        position: relative;
        overflow: hidden;
    }

    .hero-catalog::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(147,51,234,0.2), transparent);
    }

    .hero-title {
        font-size: 4.5rem;
        font-weight: 800;
        text-shadow: 0 10px 30px rgba(0,0,0,0.3);
        z-index: 2;
    }

    .hero-subtitle {
        font-size: 1.5rem;
        font-weight: 600;
        opacity: 0.9;
        z-index: 2;
    }

    /* Filter Sidebar */
    .filter-card {
        background: var(--card-bg);
        backdrop-filter: blur(24px);
        border: 1px solid var(--border);
        border-radius: 28px;
        padding: 32px;
        box-shadow: var(--shadow);
        height: fit-content;
        position: sticky;
        top: 100px;
    }

    .filter-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 20px;
    }

    /* Product Card */
    .shoe-card {
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--border);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .shoe-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 25px 60px var(--primary-glow);
    }

    .shoe-image-wrapper {
        height: 300px;
        overflow: hidden;
        position: relative;
        background: rgba(255,255,255,0.4);
    }

    .shoe-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .shoe-card:hover .shoe-image {
        transform: scale(1.15);
    }

    .discount-badge {
        position: absolute;
        top: 16px;
        left: 16px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
        box-shadow: 0 8px 20px var(--primary-glow);
    }

    .card-body {
        padding: 24px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .shoe-brand {
        font-size: 0.95rem;
        color: var(--text-muted);
        margin-bottom: 8px;
    }

    .shoe-name {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 12px;
        line-height: 1.3;
    }

    .price-wrapper {
        margin-top: auto;
    }

    .current-price {
        font-size: 1.6rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .old-price {
        font-size: 1.1rem;
        text-decoration: line-through;
        color: var(--text-muted);
        margin-left: 12px;
    }
</style>
@endpush

@section('content')
<!-- Hero -->
<div class="hero-catalog">
    <div class="position-relative z-2">
        <h1 class="hero-title">Koleksi Sepatu Premium</h1>
        <p class="hero-subtitle">Temukan style terbaik untuk setiap langkahmu</p>
    </div>
</div>

<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-transparent p-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted">Home</a></li>
            <li class="breadcrumb-item active text-primary fw-bold">Katalog Sepatu</li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Sidebar Filter -->
        <div class="col-lg-3">
            <div class="filter-card">
                <h3 class="filter-title">Filter Produk</h3>
                
                <form>
                    <!-- Category -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Kategori</h5>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="sneakers">
                            <label class="form-check-label" for="sneakers">Sneakers</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="running">
                            <label class="form-check-label" for="running">Running</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="casual">
                            <label class="form-check-label" for="casual">Casual</label>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Harga</h5>
                        <input type="range" class="form-range" min="0" max="5000000" step="100000">
                        <div class="d-flex justify-content-between text-muted small">
                            <span>Rp 0</span>
                            <span>Rp 5.000.000</span>
                        </div>
                    </div>

                    <!-- Size -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Ukuran</h5>
                        <div class="d-flex flex-wrap gap-2">
                            @for($i = 38; $i <= 44; $i++)
                                <button type="button" class="btn btn-outline-primary rounded-pill px-3 py-1">{{ $i }}</button>
                            @endfor
                        </div>
                    </div>

                    <button type="submit" class="btn btn-add-cart w-100">
                        Terapkan Filter
                    </button>
                </form>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="text-muted mb-0">Menampilkan 1-12 dari 48 produk</p>
                <select class="form-select w-auto" style="border-radius: 50px; padding: 12px 24px;">
                    <option>Urutkan: Terbaru</option>
                    <option>Harga Terendah</option>
                    <option>Harga Tertinggi</option>
                    <option>Terlaris</option>
                </select>
            </div>

            <div class="row g-4">
                @foreach($products as $product) <!-- asumsi $products dari controller -->
                    <div class="col-md-6 col-xl-4">
                        <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none">
                            <div class="shoe-card">
                                <div class="shoe-image-wrapper position-relative">
                                    @if($product->has_discount)
                                        <span class="discount-badge">PROMO {{ $product->discount_percentage }}% OFF</span>
                                    @endif
                                    <img src="{{ $product->image_url }}" class="shoe-image" alt="{{ $product->name }}">
                                </div>
                                <div class="card-body">
                                    <div class="shoe-brand">Nike • Original</div>
                                    <h3 class="shoe-name">{{ $product->name }}</h3>
                                    
                                    <div class="price-wrapper d-flex align-items-center">
                                        <div class="current-price">{{ $product->formatted_price }}</div>
                                        @if($product->has_discount)
                                            <del class="old-price">{{ $product->formatted_original_price }}</del>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $products->links() }} <!-- pake Laravel pagination -->
            </div>
        </div>
    </div>
</div>
@endsection