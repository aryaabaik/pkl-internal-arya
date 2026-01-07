@extends('layouts.app')

@section('title', 'Wishlist Saya')

@section('content')
<div class="container py-5">

    {{-- Header Section --}}
    <div class="wishlist-header d-flex justify-content-between align-items-center mb-5 p-4 rounded-4">
        <div>
            <h1 class="h2 fw-800 mb-1 text-purple-gradient">Wishlist Saya</h1>
            <p class="text-muted mb-0 small fw-medium">Simpan produk impianmu dan wujudkan kemudian ✨</p>
        </div>
        <div class="stats-badge">
            <i class="bi bi-heart-fill me-2"></i>
            <span>{{ $products->total() }} Produk</span>
        </div>
    </div>

    @if($products->count())
        {{-- Produk Grid --}}
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 wishlist-grid">
            @foreach($products as $product)
                <div class="col wishlist-item">
                    <div class="wishlist-card h-100">
                        <div class="card-wrapper position-relative">
                            {{-- Tombol Hapus Cepat (Opsional jika ada route-nya) --}}
                            <div class="remove-wishlist-overlay">
                                <x-product-card :product="$product" />
                            </div>
                        </div>
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
        <div class="wishlist-empty-container text-center py-5">
            <div class="empty-icon-wrapper mb-4">
                <i class="bi bi-heart-pulse"></i>
            </div>
            <h3 class="fw-800 mb-2">Wishlist Kamu Masih Kosong</h3>
            <p class="text-muted mb-4 mx-auto" style="max-width: 400px;">
                Sepertinya kamu belum menemukan produk yang pas. Yuk, jelajahi koleksi terbaru kami!
            </p>
            <a href="{{ route('catalog.index') }}" class="btn btn-explore">
                <i class="bi bi-bag-heart me-2"></i>Mulai Jelajahi
            </a>
        </div>
    @endif
</div>

{{-- Custom Style --}}
<style>
    :root {
        --primary-purple: #7c3aed;
        --secondary-purple: #f5f3ff;
        --grad-purple: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
        --text-main: #1e1b4b;
    }

    .fw-800 { font-weight: 800; }

    /* Header Styling */
    .wishlist-header {
        background: white;
        border: 1px solid rgba(124, 58, 237, 0.1);
        box-shadow: 0 10px 30px rgba(124, 58, 237, 0.05);
    }

    .text-purple-gradient {
        background: var(--grad-purple);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .stats-badge {
        background: var(--secondary-purple);
        color: var(--primary-purple);
        padding: 10px 20px;
        border-radius: 100px;
        font-weight: 700;
        font-size: 0.9rem;
        border: 1px solid rgba(124, 58, 237, 0.1);
    }

    /* Card Hover Effect */
    .wishlist-card {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .wishlist-card:hover {
        transform: translateY(-10px);
    }

    /* Grid Animation */
    .wishlist-item {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeUp 0.6s cubic-bezier(0.23, 1, 0.32, 1) forwards;
    }

    @keyframes fadeUp {
        to { opacity: 1; transform: translateY(0); }
    }

    /* Loop delay for children */
    @for ($i = 1; $i <= 20; $i++)
        .wishlist-item:nth-child({{ $i }}) { animation-delay: {{ $i * 0.08 }}s; }
    @endfor

    /* Pagination Styling */
    .wishlist-pagination .page-link {
        border: none;
        background: white;
        color: var(--text-main);
        margin: 0 4px;
        border-radius: 12px !important;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    }

    .wishlist-pagination .page-item.active .page-link {
        background: var(--grad-purple);
        color: white;
        box-shadow: 0 8px 15px rgba(124, 58, 237, 0.3);
    }

    /* Empty State Styling */
    .wishlist-empty-container {
        background: white;
        border-radius: 32px;
        border: 2px dashed #e2e8f0;
        padding: 80px 20px;
    }

    .empty-icon-wrapper {
        width: 100px;
        height: 100px;
        background: var(--secondary-purple);
        color: var(--primary-purple);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 3rem;
        animation: heartBeat 2s infinite;
    }

    @keyframes heartBeat {
        0% { transform: scale(1); }
        14% { transform: scale(1.1); }
        28% { transform: scale(1); }
        42% { transform: scale(1.1); }
        70% { transform: scale(1); }
    }

    .btn-explore {
        background: var(--grad-purple);
        color: white;
        padding: 14px 32px;
        border-radius: 100px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(124, 58, 237, 0.2);
    }

    .btn-explore:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(124, 58, 237, 0.3);
        color: white;
    }
</style>
@endsection