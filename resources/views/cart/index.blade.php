@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@push('styles')
<style>
    :root {
        --primary-purple: #7c3aed;
        --secondary-purple: #f5f3ff;
        --text-main: #1e1b4b;
        --grad-purple: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
    }

    body { background-color: #f8fafc; color: var(--text-main); }

    .cart-title {
        font-weight: 800;
        letter-spacing: -1px;
        background: var(--grad-purple);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    /* Cart Table Styles */
    .cart-card {
        border: none;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(124, 58, 237, 0.05);
    }

    .table thead {
        background-color: var(--secondary-purple);
        border-bottom: 2px solid #ede9fe;
    }

    .table thead th {
        padding: 20px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        color: var(--primary-purple);
    }

    .cart-item-row {
        transition: all 0.3s ease;
        vertical-align: middle;
    }

    .cart-item-row:hover {
        background-color: #fcfaff !important;
    }

    .product-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    /* Qty Input Styles */
    .qty-wrapper {
        background: #f1f5f9;
        border-radius: 100px;
        padding: 4px;
        display: inline-flex;
        align-items: center;
        border: 1px solid #e2e8f0;
    }

    .qty-input-cart {
        width: 45px;
        border: none;
        background: transparent;
        text-align: center;
        font-weight: 700;
        color: var(--primary-purple);
    }

    /* Summary Card */
    .summary-card {
        border: none;
        border-radius: 24px;
        background: white;
        position: sticky;
        top: 100px;
        box-shadow: 0 20px 40px rgba(124, 58, 237, 0.08);
        border: 1px solid rgba(124, 58, 237, 0.1);
    }

    .btn-checkout {
        background: var(--grad-purple);
        color: white;
        border: none;
        padding: 16px;
        border-radius: 16px;
        font-weight: 700;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(124, 58, 237, 0.2);
    }

    .btn-checkout:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(124, 58, 237, 0.3);
        color: white;
    }

    .empty-cart-icon {
        width: 120px;
        height: 120px;
        background: var(--secondary-purple);
        color: var(--primary-purple);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto 24px;
        font-size: 3rem;
    }

    .remove-btn {
        color: #ef4444;
        background: #fef2f2;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 10px;
        transition: 0.2s;
    }

    .remove-btn:hover {
        background: #ef4444;
        color: white;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="d-flex align-items-center mb-5">
        <div class="bg-primary-purple p-2 rounded-3 me-3" style="background: var(--grad-purple)">
            <i class="bi bi-cart3 text-white fs-4"></i>
        </div>
        <h2 class="cart-title m-0">Keranjang Belanja</h2>
    </div>

    @if($cart && $cart->items->count())
        <div class="row g-4">
            {{-- Cart Items --}}
            <div class="col-lg-8">
                <div class="card cart-card shadow-sm">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-end">Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart->items as $item)
                                    <tr class="cart-item-row">
                                        <td class="py-4 ps-4">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $item->product->image_url }}" class="product-img me-3">
                                                <div>
                                                    <a href="{{ route('catalog.show', $item->product->slug) }}"
                                                       class="text-decoration-none text-dark fw-bold mb-1 d-block">
                                                        {{ Str::limit($item->product->name, 40) }}
                                                    </a>
                                                    <span class="badge bg-light text-primary rounded-pill fw-normal">
                                                        {{ $item->product->category->name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle fw-medium">
                                            {{ $item->product->formatted_price }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="qty-wrapper">
                                                    <input type="number" name="quantity" 
                                                           value="{{ $item->quantity }}" 
                                                           min="1" max="{{ $item->product->stock }}"
                                                           class="qty-input-cart"
                                                           onchange="this.form.submit()">
                                                </div>
                                            </form>
                                        </td>
                                        <td class="text-end align-middle fw-bold text-primary">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center align-middle pe-4">
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="remove-btn" 
                                                        onclick="return confirm('Hapus item ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="col-lg-4">
                <div class="card summary-card p-4">
                    <h5 class="fw-bold mb-4">Ringkasan Belanja</h5>
                    
                    <div class="d-flex justify-content-between mb-3 text-secondary">
                        <span>Total Harga ({{ $cart->items->sum('quantity') }} barang)</span>
                        <span>Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-3 text-secondary">
                        <span>Diskon Belanja</span>
                        <span class="text-success fw-medium">- Rp 0</span>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-bold fs-5">Total Bayar</span>
                        <span class="fw-800 fs-4 text-primary" style="color: var(--primary-purple) !important;">
                            Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}
                        </span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn btn-checkout w-100 mb-3">
                        <i class="bi bi-shield-lock-fill me-2"></i>Lanjut ke Checkout
                    </a>
                    
                    <a href="{{ route('catalog.index') }}" class="btn btn-link w-100 text-decoration-none text-muted fw-bold small">
                        <i class="bi bi-arrow-left me-2"></i>Kembali Belanja
                    </a>
                </div>

                {{-- Promo Code Box (Bonus) --}}
                <div class="card border-0 rounded-4 mt-3 bg-light p-3">
                    <div class="d-flex align-items-center gap-2 text-primary fw-bold small">
                        <i class="bi bi-ticket-perforated-fill fs-5"></i>
                        Punya kode promo? Masukkan di sini
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Empty Cart --}}
        <div class="text-center py-5">
            <div class="empty-cart-icon">
                <i class="bi bi-cart-x"></i>
            </div>
            <h3 class="fw-800">Wah, keranjangmu masih kosong</h3>
            <p class="text-muted mb-4">Yuk, cari perlengkapan sekolah favoritmu dan isi keranjang ini!</p>
            <a href="{{ route('catalog.index') }}" class="btn btn-checkout px-5">
                <i class="bi bi-search me-2"></i>Mulai Cari Produk
            </a>
        </div>
    @endif
</div>
@endsection