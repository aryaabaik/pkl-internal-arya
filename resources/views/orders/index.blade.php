@extends('layouts.app')

@section('content')
<style>
    /* =========================
   SCHOOL STORE – ORDER CARD
   BUG FREE VERSION
========================= */

.order-card {
    position: relative;
    border-radius: 18px;
    background: #ffffff;
    box-shadow: 0 12px 30px rgba(0,0,0,.08);
    transition: all .3s ease;
    overflow: hidden;
}

/* hover background TANPA overlay */
.order-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(0,0,0,.12);
    background: linear-gradient(120deg, #e3f2fd, #ffffff);
}

.order-thumb {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 14px;
    background: #f1f5f9;
    border: 2px dashed #cfe2ff;
}

.order-badge {
    font-size: 12px;
    padding: 6px 12px;
    border-radius: 999px;
    font-weight: 600;
    white-space: nowrap;
}

.order-price {
    color: #0d6efd;
    font-size: 1.05rem;
}

.school-icon {
    background: #e3f2fd;
    color: #0d6efd;
    padding: 8px 14px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 600;
}

.order-actions .btn {
    border-radius: 12px;
}

/* EMPTY STATE */
.empty-illustration {
    background: linear-gradient(135deg, #e3f2fd, #ffffff);
    border-radius: 24px;
    padding: 48px;
}

</style>
<div class="container py-5">

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">🎒 Pesanan Saya</h1>
            <p class="text-muted mb-0">
                Semua perlengkapan sekolah yang kamu pesan
            </p>
        </div>
        <div class="school-icon mt-3 mt-md-0">
            Total: {{ $orders->total() }}
        </div>
    </div>

    @if($orders->count())
    <div class="row g-4">

        @foreach($orders as $order)
        @php
            $firstItem = $order->items->first();
            $thumb = optional($firstItem->product)->image_url ?? asset('images/order-placeholder.png');
        @endphp

        <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-in-up">
            <div class="order-card h-100">

                <div class="p-4">
                    {{-- HEADER CARD --}}
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $thumb }}" alt="Produk" class="order-thumb me-3">

                        <div class="flex-grow-1">
                            <div class="fw-bold text-primary">
                                #{{ $order->order_number }}
                            </div>
                            <small class="text-muted">
                                {{ $order->created_at->format('d M Y • H:i') }}
                            </small>
                        </div>

                        <span class="order-badge
                            @if($order->status == 'pending') bg-warning text-dark
                            @elseif($order->status == 'processing') bg-info text-dark
                            @elseif($order->status == 'shipped') bg-primary text-white
                            @elseif($order->status == 'delivered') bg-success text-white
                            @elseif($order->status == 'cancelled') bg-danger text-white
                            @else bg-secondary text-white
                            @endif
                        ">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    {{-- ITEM --}}
                    <div class="mb-3">
                        <div class="text-muted small">
                            📚
                            @if($order->items->count())
                                {{ $order->items->first()->product->name ?? $order->items->first()->product_name }}
                                @if($order->items->count() > 1)
                                    <span class="fw-semibold text-primary">
                                        +{{ $order->items->count() - 1 }} item
                                    </span>
                                @endif
                            @else
                                -
                            @endif
                        </div>
                    </div>

                    {{-- TOTAL --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted small">Total Pembayaran</span>
                        <span class="order-price fw-bold">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>

                    {{-- ACTION --}}
                    <div class="d-flex justify-content-between order-actions">
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye"></i> Detail
                        </a>

                        @if(Route::has('orders.invoice'))
                        <a href="{{ route('orders.invoice', $order) }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-receipt"></i> Invoice
                        </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        @endforeach

    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $orders->links() }}
    </div>

    @else
    {{-- EMPTY --}}
    <div class="text-center empty-illustration">
        <img src="/images/empty-orders.svg" class="mb-4" style="max-width:220px;">
        <h4 class="fw-bold">Belum Ada Pesanan 📦</h4>
        <p class="text-muted mb-4">
            Ayo lengkapi kebutuhan sekolahmu sekarang!
        </p>
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg rounded-pill px-4">
            ✏️ Mulai Belanja
        </a>
    </div>
    @endif

</div>
@endsection
