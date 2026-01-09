@extends('layouts.app')

<style>
    :root {
        --primary: #9333ea;        /* Purple utama */
        --primary-light: #c084fc;
        --primary-lighter: #e9d5ff;
        --primary-dark: #7c3aed;
        --primary-glow: rgba(147, 51, 234, 0.4);
        --bg: linear-gradient(135deg, #f3e8ff, #fae8ff);
        --card-bg: rgba(255, 255, 255, 0.7);
        --text: #581c87;
        --text-muted: #a78bfa;
        --border: rgba(147, 51, 234, 0.2);
        --shadow: 0 8px 32px rgba(147, 51, 234, 0.15);
        --glow-shadow: 0 0 20px rgba(147, 51, 234, 0.3);
        --transition: all 0.4s ease;
    }

    .dark {
        --bg: linear-gradient(135deg, #4c1d95, #6b21b3);
        --card-bg: rgba(30, 10, 60, 0.6);
        --text: #f3e8ff;
        --text-muted: #c084fc;
        --border: rgba(196, 132, 252, 0.3);
        --shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    }

    body {
        background: var(--bg);
        color: var(--text);
        transition: var(--transition);
        min-height: 100vh;
    }

    .container {
        max-width: 1400px;
    }

    /* Sidebar Filter - Glassmorphism + Glow */
    .sidebar-filter {
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid var(--border);
        border-radius: 20px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .sidebar-filter .card-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: white;
        padding: 1.5rem;
        font-size: 1.25rem;
        font-weight: 800;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        box-shadow: var(--glow-shadow);
    }

    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
        box-shadow: var(--glow-shadow);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        border-radius: 12px;
        padding: 0.85rem;
        font-weight: 700;
        box-shadow: var(--glow-shadow);
        transition: var(--transition);
    }

    .btn-primary:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 35px var(--primary-glow);
    }

    .btn-outline-secondary {
        border-radius: 12px;
    }

    /* Product Card */
    .product-card {
        background: var(--card-bg);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        backdrop-filter: blur(10px);
    }

    .product-card:hover {
        transform: translateY(-15px) scale(1.05);
        box-shadow: 0 25px 50px var(--primary-glow);
    }

    .product-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 30% 30%, var(--primary-light), transparent 70%);
        opacity: 0;
        transition: opacity 0.5s;
        pointer-events: none;
        z-index: 1;
    }

    .product-card:hover::before {
        opacity: 0.6;
    }

    .product-card img {
        transition: transform 0.7s ease;
    }

    .product-card:hover img {
        transform: scale(1.15);
    }

    /* Header */
    .catalog-header h4 {
        font-weight: 800;
        color: var(--primary-dark);
        text-shadow: 0 2px 8px rgba(147, 51, 234, 0.2);
    }

    /* Empty State Modern - Tanpa Card */
    .empty-state-modern {
        animation: fadeIn 1.2s ease-out;
    }

    .glow-effect {
        filter: drop-shadow(0 0 30px var(--primary-glow));
        transition: transform 0.4s ease;
    }

    .glow-effect:hover {
        transform: scale(1.05);
    }

    .shadow-glow {
        box-shadow: 0 10px 30px var(--primary-glow) !important;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Pagination */
    .pagination .page-link {
        border-radius: 12px;
        border: 1px solid var(--border);
        color: var(--text);
        background: var(--card-bg);
        transition: var(--transition);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-color: var(--primary);
        box-shadow: var(--glow-shadow);
    }

    .pagination .page-link:hover {
        background: var(--primary-light);
        color: white;
        transform: translateY(-3px);
    }

    @media (max-width: 992px) {
        .sidebar-filter {
            margin-bottom: 2.5rem;
        }
    }
</style>

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- SIDEBAR FILTER -->
        <div class="col-lg-3 mb-4">
            <div class="card border-0 sidebar-filter">
                <div class="card-header">Filter Alat Sekolah</div>
                <div class="card-body">
                    <form action="{{ route('catalog.index') }}" method="GET">
                        @if(request('q')) 
                            <input type="hidden" name="q" value="{{ request('q') }}"> 
                        @endif

                        <!-- Kategori -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3" style="color: var(--primary);">Kategori</h6>
                            @foreach($categories as $cat)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="category" value="{{ $cat->slug }}"
                                        {{ request('category') == $cat->slug ? 'checked' : '' }}
                                        onchange="this.form.submit()">
                                    <label class="form-check-label">{{ $cat->name }} <small>({{ $cat->products_count }})</small></label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Harga -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3" style="color: var(--primary);">Rentang Harga</h6>
                            <div class="d-flex gap-2">
                                <input type="number" name="min_price" class="form-control rounded-pill" placeholder="Min" value="{{ request('min_price') }}">
                                <input type="number" name="max_price" class="form-control rounded-pill" placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Terapkan</button>
                        <a href="{{ route('catalog.index') }}" class="btn btn-outline-secondary w-100 mt-2 rounded-pill">Reset Filter</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- PRODUCT GRID -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4 catalog-header">
                <h4 class="mb-0">Katalog Peralatan Sekolah</h4>
                <form method="GET" class="d-inline-block">
                    @foreach(request()->except('sort') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <select name="sort" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                    </select>
                </form>
            </div>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @forelse($products as $product)
                    <div class="col">
                        <div class="product-card h-100 position-relative">
                            <x-product-card :product="$product" />
                        </div>
                    </div>
                @empty
                    <div class="col-12 py-5 my-5">
                        <div class="empty-state-modern text-center">
                            <!-- Ilustrasi Cute -->
                            <img 
                                src="{{ asset('images/empty-school.svg') }}" 
                                width="300" 
                                class="mb-5 opacity-90 glow-effect" 
                                alt="Produk kosong"
                                style="max-width: 100%; height: auto;"
                            >

                            <!-- Teks dengan Glow -->
                            <h3 class="mb-3 fw-bold" style="color: var(--primary-dark); text-shadow: 0 0 20px var(--primary-glow);">
                                Ups, Belum Ada Produk Nih! 📚✏️
                            </h3>
                            
                            <p class="lead text-muted mb-4" style="font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
                                Coba kurangi filter, ganti kata kunci pencarian, atau <br> kembali ke halaman utama ya~
                            </p>

                            <!-- Tombol Aksi -->
                            <a href="{{ route('catalog.index') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-glow">
                                Kembali Belanja
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($products->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection