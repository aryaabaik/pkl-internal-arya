@extends('layouts.app')

<style>
:root {
    --primary: #6366f1;
    --primary-soft: #eef2ff;
    --text-main: #0f172a;
    --text-muted: #64748b;
    --border-soft: rgba(15,23,42,.08);
    --card-bg: #ffffff;
    --transition: all .25s ease;
}

/* ================= BASE ================= */
.catalog-container {
    max-width: 1400px;
}

.catalog-title {
    font-weight: 800;
    letter-spacing: -.02em;
    color: var(--text-main);
}

/* ================= SIDEBAR ================= */
.sidebar-filter {
    background: var(--card-bg);
    border: 1px solid var(--border-soft);
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(15,23,42,.05);
}

.sidebar-filter h6 {
    font-weight: 700;
    margin-bottom: 14px;
}

.form-check-input:checked {
    background-color: var(--primary);
    border-color: var(--primary);
}

.form-check-label {
    cursor: pointer;
    color: var(--text-main);
}

.form-check-label small {
    color: var(--text-muted);
}

.btn-primary {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    border: none;
    border-radius: 10px;
    font-weight: 600;
}

.btn-primary:hover {
    opacity: .95;
}

.btn-outline-secondary {
    border-radius: 10px;
}

/* ================= HEADER ================= */
.catalog-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.form-select {
    border-radius: 10px;
    border: 1px solid var(--border-soft);
    font-weight: 500;
}

/* ================= GRID ================= */
.product-grid {
    row-gap: 28px;
}

/* wrapper JANGAN ganggu click */
.product-card-wrapper {
    height: 100%;
}

/* ================= EMPTY ================= */
.empty-state h5 {
    font-weight: 700;
}

/* ================= PAGINATION ================= */
.pagination .page-link {
    border-radius: 10px;
    margin: 0 4px;
    border: 1px solid var(--border-soft);
    color: var(--text-main);
}

.pagination .page-item.active .page-link {
    background: var(--primary);
    border-color: var(--primary);
    color: #fff;
}

.pagination .page-link:hover {
    background: var(--primary-soft);
}
</style>

@section('content')
<div class="container catalog-container py-5">
    <div class="row">

        {{-- ================= SIDEBAR ================= --}}
        <div class="col-lg-3 mb-4">
            <div class="sidebar-filter">
                <form action="{{ route('catalog.index') }}" method="GET">
                    @if(request('q'))
                        <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif

                    {{-- KATEGORI --}}
                    <div class="mb-4">
                        <h6>Kategori</h6>
                        @foreach($categories as $cat)
                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="category"
                                    value="{{ $cat->slug }}"
                                    {{ request('category') == $cat->slug ? 'checked' : '' }}
                                    onchange="this.form.submit()"
                                >
                                <label class="form-check-label">
                                    {{ $cat->name }}
                                    <small>({{ $cat->products_count }})</small>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    {{-- HARGA --}}
                    <div class="mb-4">
                        <h6>Rentang Harga</h6>
                        <div class="d-flex gap-2">
                            <input type="number" name="min_price" class="form-control" placeholder="Min" value="{{ request('min_price') }}">
                            <input type="number" name="max_price" class="form-control" placeholder="Max" value="{{ request('max_price') }}">
                        </div>
                    </div>

                    <button class="btn btn-primary w-100">Terapkan</button>
                    <a href="{{ route('catalog.index') }}" class="btn btn-outline-secondary w-100 mt-2">Reset</a>
                </form>
            </div>
        </div>

        {{-- ================= PRODUCT ================= --}}
        <div class="col-lg-9">
            <div class="catalog-header">
                <h4 class="catalog-title mb-0">Katalog Produk</h4>

                {{-- SORT --}}
                <form method="GET">
                    @foreach(request()->except('sort') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                    </select>
                </form>
            </div>

            <div class="row row-cols-1 row-cols-md-3 product-grid">
                @forelse($products as $product)
                    <div class="col">
                        <div class="product-card-wrapper">
                            <x-product-card :product="$product" />
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 empty-state">
                        <img src="{{ asset('images/empty-state.svg') }}" width="140" class="mb-3 opacity-50">
                        <h5>Produk tidak ditemukan</h5>
                        <p class="text-muted">Coba ubah filter atau kata kunci.</p>
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
