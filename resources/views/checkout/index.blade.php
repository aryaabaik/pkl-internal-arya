@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

<style>
    /* ===== Purple Theme ===== */
    :root {
        --primary-purple: #7c3aed;
        --secondary-purple: #f5f3ff;
        --grad-purple: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
        --text-main: #1e1b4b;
    }

    body {
        background: #f8fafc;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text-main);
    }

    .checkout-container {
        margin-top: 60px;
        padding-bottom: 100px;
    }

    .section-title {
        font-weight: 800;
        font-size: 2.2rem;
        letter-spacing: -1px;
        background: var(--grad-purple);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    .soft-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 12px 35px rgba(124, 58, 237, 0.06);
        border: 1px solid rgba(124, 58, 237, 0.08);
        transition: all 0.3s ease;
    }

    .soft-card + .soft-card {
        margin-top: 24px;
    }

    .soft-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(124, 58, 237, 0.1);
    }

    .label {
        font-weight: 700;
        font-size: 15px;
        margin-bottom: 8px;
        color: var(--text-main);
        display: block;
    }

    .form-control {
        border-radius: 16px;
        padding: 14px 18px;
        border: 1px solid #e2e8f0;
        background: #fbfbfe;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-purple);
        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.15);
        background: #fff;
    }

    .is-invalid {
        border-color: #ef4444 !important;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .checkout-summary {
        position: sticky;
        top: 110px;
    }

    .product-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 1px dashed #e2e8f0;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .product-row:last-child {
        border-bottom: none;
    }

    .product-row:hover {
        background: #faf5ff;
    }

    .product-row small {
        color: #6b7280;
        font-weight: 500;
    }

    .total-box {
        background: var(--secondary-purple);
        padding: 20px;
        border-radius: 18px;
        border: 1px solid rgba(124, 58, 237, 0.1);
    }

    .total-amount {
        color: var(--primary-purple);
        font-weight: 800;
        font-size: 1.4rem;
    }

    .checkout-btn {
        background: var(--grad-purple);
        border: none;
        color: white;
        padding: 18px;
        font-weight: 700;
        border-radius: 18px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 25px rgba(124, 58, 237, 0.3);
    }

    .checkout-btn:hover {
        transform: scale(1.03) translateY(-3px);
        background: linear-gradient(135deg, #9d4edd, #5b21b6);
        box-shadow: 0 15px 35px rgba(124, 58, 237, 0.5);
        color: white;
    }

    .badge-icon {
        width: 32px;
        height: 32px;
        background: var(--secondary-purple);
        color: var(--primary-purple);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin-right: 10px;
    }

    .fade-in {
        animation: fade 0.6s ease-out forwards;
    }

    .fade-in-delay-1 {
        animation-delay: 0.2s;
    }

    .fade-in-delay-2 {
        animation-delay: 0.4s;
    }

    .fade-in-delay-3 {
        animation-delay: 0.6s;
    }

    @keyframes fade {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 991px) {
        .checkout-summary {
            position: relative;
            top: 0;
            margin-top: 20px;
        }
    }
</style>

<div class="container checkout-container fade-in">

    <div class="text-center mb-4">
        <div class="mb-3">
            <div class="progress" style="height:8px; border-radius:6px;">
                <div class="progress-bar" role="progressbar" style="width: 70%; background: var(--primary-purple);" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted mt-1 d-block">Langkah 2 dari 3: Finalisasi Pesanan</small>
        </div>
        <h1 class="section-title">Finalisasi Pesanan</h1>
        <p class="text-muted fw-medium">Satu langkah lagi untuk mendapatkan produk impianmu</p>
    </div>

    @php
        $subtotal = $cart->items->sum(fn($i) => ($i->product?->price ?? 0) * $i->quantity);
        $shipping = 15000;
        $total = $subtotal + $shipping;
    @endphp

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="row g-4">

            <div class="col-lg-7">

                <div class="soft-card fade-in-delay-1">
                    <h5 class="mb-4 fw-bold d-flex align-items-center">
                        <span class="badge-icon"><i class="bi bi-person-fill"></i></span>
                        Data Penerima
                    </h5>

                    <div class="mb-3">
                        <label class="label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name ?? '') }}" placeholder="Masukkan nama penerima" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="label">Nomor WhatsApp</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->phone ?? '') }}" placeholder="Contoh: 0812..." required>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="label">Alamat Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email ?? '') }}" placeholder="email@anda.com" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="soft-card fade-in-delay-2">
                    <h5 class="mb-4 fw-bold d-flex align-items-center">
                        <span class="badge-icon"><i class="bi bi-geo-alt-fill"></i></span>
                        Alamat Pengiriman
                    </h5>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="4" placeholder="Tuliskan alamat lengkap (Nama Jalan, No. Rumah, RT/RW, Kecamatan)" required>{{ old('address', auth()->user()->address ?? '') }}</textarea>
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="soft-card fade-in-delay-3">
                    <h5 class="mb-4 fw-bold d-flex align-items-center">
                        <span class="badge-icon"><i class="bi bi-chat-left-text-fill"></i></span>
                        Catatan Pesanan
                    </h5>
                    <textarea name="notes" class="form-control" rows="3" placeholder="Contoh: Titipkan di satpam atau warna cadangan...">{{ old('notes') }}</textarea>
                </div>

            </div>

            <div class="col-lg-5">
                <div class="soft-card checkout-summary fade-in-delay-1">

                    <h5 class="fw-bold mb-4">Ringkasan Pesanan</h5>

                    <div class="mb-4">
                        @foreach($cart->items as $item)
                        <div class="product-row">
                            <div style="max-width: 70%;">
                                <strong class="d-block text-truncate">{{ $item->product->name }}</strong>
                                <small>{{ $item->quantity }} unit x Rp {{ number_format($item->product->price, 0, ',', '.') }}</small>
                            </div>
                            <div class="text-end">
                                <span class="fw-bold">Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-between mb-2 text-secondary fw-medium">
                        <span>Subtotal Produk</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3 text-secondary fw-medium">
                        <span>Biaya Pengiriman</span>
                        <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                    </div>

                    <div class="total-box mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark">Total Pembayaran</span>
                            <span class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="checkout-btn w-100 mt-4">
                        <i class="bi bi-shield-lock-fill me-2"></i> Buat Pesanan Sekarang
                    </button>

                    <div class="mt-4 p-3 rounded-4 bg-light border text-center">
                        <div class="small text-muted mb-2">Metode Pembayaran Tersedia:</div>
                        <div class="d-flex justify-content-center gap-3 opacity-50 grayscale" style="filter: grayscale(1);">
                            <i class="bi bi-bank fs-4"></i>
                            <i class="bi bi-wallet2 fs-4"></i>
                            <i class="bi bi-qr-code-scan fs-4"></i>
                        </div>
                        <p class="text-muted mt-3 mb-0" style="font-size: 0.75rem;">
                             Data Anda dilindungi dengan enkripsi SSL 256-bit.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </form>

</div>

@endsection
