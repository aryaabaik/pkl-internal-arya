@extends('layouts.app')
<style>
    :root {
        --primary: #6366f1; /* Indigo sebagai warna utama */
        --primary-light: #818cf8;
        --primary-dark: #4f46e5;
        --bg: #f8fafc;
        --card-bg: #ffffff;
        --text: #1e293b;
        --text-muted: #64748b;
        --border: #e2e8f0;
        --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Dark mode support (tambahkan class .dark ke body jika ingin dark mode) */
    .dark {
        --bg: #0f172a;
        --card-bg: #1e293b;
        --text: #f1f5f9;
        --text-muted: #94a3b8;
        --border: #334155;
        --shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    body {
        background: var(--bg);
        color: var(--text);
        transition: var(--transition);
    }

    .container {
        max-width: 1400px;
    }

    /* Sidebar Filter - Glassmorphism Style Canggih */
    .sidebar-filter {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        box-shadow: var(--shadow);
        overflow: hidden;
        transition: var(--transition);
    }

    .sidebar-filter .card-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: white;
        padding: 1.25rem;
        font-size: 1.125rem;
        font-weight: 700;
    }

    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .form-check-label {
        cursor: pointer;
        transition: var(--transition);
    }

    .form-check:hover .form-check-label {
        color: var(--primary);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        border-radius: 8px;
        padding: 0.75rem;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
    }

    .btn-outline-secondary {
        border-radius: 8px;
        transition: var(--transition);
    }

    /* Product Grid & Cards - Advanced Hover Effects */
    .product-card-wrapper {
        perspective: 1000px; /* Untuk efek 3D subtle */
    }

    .product-card {
        background: var(--card-bg);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-12px) scale(1.03);
        box-shadow: 0 20px 40px rgba(99, 102, 241, 0.25);
        z-index: 10;
    }

    /* Glow on hover */
    .product-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at 50% 50%, rgba(99, 102, 241, 0.15), transparent 70%);
        opacity: 0;
        transition: opacity 0.4s;
        pointer-events: none;
        z-index: 1;
    }

    .product-card:hover::before {
        opacity: 1;
    }

    /* Image zoom subtle */
    .product-card img {
        transition: transform 0.6s ease;
    }

    .product-card:hover img {
        transform: scale(1.1);
    }

    /* Sorting & Header */
    .catalog-header {
        border-bottom: 1px solid var(--border);
        padding-bottom: 1rem;
    }

    .form-select {
        border-radius: 8px;
        border: 1px solid var(--border);
        background: var(--card-bg);
        transition: var(--transition);
    }

    .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
    }

    /* Empty State */
    .empty-state img {
        filter: drop-shadow(0 4px 10px rgba(0,0,0,0.1));
    }

    /* Pagination - Modern Bootstrap 5 Style */
    .pagination .page-link {
        border-radius: 8px;
        margin: 0 4px;
        padding: 8px 16px;
        color: var(--text);
        border: 1px solid var(--border);
        transition: var(--transition);
    }

    .pagination .page-item.active .page-link {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .pagination .page-link:hover {
        background: var(--primary-light);
        color: white;
        transform: translateY(-2px);
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .sidebar-filter {
            margin-bottom: 2rem;
        }
    }
</style>
@section('content')
<div class="container py-5">
    <div class="row">
        {{-- SIDEBAR FILTER --}}
        <div class="col-lg-3 mb-4">
            <div class="card border-0 sidebar-filter">
                <div class="card-header bg-white fw-bold">Filter Produk</div>
                <div class="card-body">
                    <form action="{{ route('catalog.index') }}" method="GET">
                        @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif

                        {{-- Filter Kategori --}}
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Kategori</h6>
                            @foreach($categories as $cat)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="category" value="{{ $cat->slug }}"
                                        {{ request('category') == $cat->slug ? 'checked' : '' }}
                                        onchange="this.form.submit()">
                                    <label class="form-check-label">{{ $cat->name }} <small class="text-muted">({{ $cat->products_count }})</small></label>
                                </div>
                            @endforeach
                        </div>

                        {{-- Filter Harga --}}
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Rentang Harga</h6>
                            <div class="d-flex gap-2">
                                <input type="number" name="min_price" class="form-control" placeholder="Min" value="{{ request('min_price') }}">
                                <input type="number" name="max_price" class="form-control" placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
                        <a href="{{ route('catalog.index') }}" class="btn btn-outline-secondary w-100 mt-2">Reset</a>
                    </form>
                </div>
            </div>
        </div>

        {{-- PRODUCT GRID --}}
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4 catalog-header">
                <h4 class="mb-0">Katalog Produk</h4>
                {{-- Sorting --}}
                <form method="GET" class="d-inline-block">
                    @foreach(request()->except('sort') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <select name="sort" class="form-select w-auto" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                    </select>
                </form>
            </div>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @forelse($products as $product)
                    <div class="col">
                        <div class="product-card-wrapper">
                            <x-product-card :product="$product" class="product-card h-100" />
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 empty-state">
                        <img src="{{ asset('images/empty-state.svg') }}" width="150" class="mb-3 opacity-50">
                        <h5>Produk tidak ditemukan</h5>
                        <p class="text-muted">Coba kurangi filter atau gunakan kata kunci lain.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection