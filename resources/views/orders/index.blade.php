@extends('layouts.app')

@section('content')
<style>
:root {
    --primary: #4f46e5;
    --border: #e5e7eb;
    --muted: #6b7280;
    --bg-soft: #f9fafb;
}

/* PAGE */
.order-page {
    background: #f6f7fb;
}

/* CARD */
.order-card {
    background: #fff;
    border-radius: 14px;
    padding: 22px;
    height: 100%;
    border: 1px solid var(--border);
    box-shadow: 0 6px 18px rgba(0,0,0,.06);
}

/* HEADER */
.order-number {
    font-weight: 800;
    font-size: .95rem;
    color: var(--primary);
}

/* THUMB */
.order-thumb {
    width: 64px;
    height: 64px;
    border-radius: 10px;
    object-fit: cover;
    background: var(--bg-soft);
    border: 1px solid var(--border);
}

/* STATUS */
.order-status {
    font-size: 11px;
    padding: 5px 12px;
    border-radius: 999px;
    font-weight: 600;
    text-transform: uppercase;
}

/* ITEM */
.order-item {
    background: var(--bg-soft);
    border-radius: 10px;
    padding: 12px 14px;
    font-size: 14px;
}

/* PRICE */
.order-price {
    font-size: 1.05rem;
    font-weight: 800;
    color: #111827;
}

/* BUTTON */
.order-btn {
    border-radius: 10px;
    font-weight: 600;
}

.order-btn-primary {
    background: var(--primary);
    color: #fff;
    border: none;
}

.order-btn-primary:hover {
    background: #4338ca;
}

.order-btn-outline {
    border: 1px solid var(--border);
    color: #374151;
}

.order-btn-outline:hover {
    background: var(--bg-soft);
}

/* COUNTER */
.order-counter {
    background: #fff;
    border: 1px solid var(--border);
    padding: 10px 20px;
    border-radius: 999px;
    font-weight: 700;
}

/* EMPTY */
.empty-state {
    background: #fff;
    border-radius: 18px;
    padding: 70px 40px;
    border: 1px solid var(--border);
}
</style>

<div class="order-page py-5">
<div class="container">

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold mb-1">Pesanan Saya</h1>
            <p class="text-muted mb-0">Riwayat transaksi akun</p>
        </div>
        <div class="order-counter mt-3 mt-md-0">
            Total: {{ $orders->total() }}
        </div>
    </div>

    @if($orders->count())
    <div class="row g-4">

        @foreach($orders as $order)
        @php
            $item = $order->items->first();
            $thumb = optional($item->product)->image_url ?? asset('images/order-placeholder.png');
        @endphp

        <div class="col-12 col-md-6 col-lg-4">
            <div class="order-card">

                <div class="d-flex align-items-center mb-4">
                    <img src="{{ $thumb }}" class="order-thumb me-3">

                    <div class="flex-grow-1">
                        <div class="order-number">
                            #{{ $order->order_number }}
                        </div>
                        <small class="text-muted">
                            {{ $order->created_at->format('d M Y • H:i') }}
                        </small>
                    </div>

                    <span class="order-status
                        @if($order->status == 'pending') bg-warning text-dark
                        @elseif($order->status == 'processing') bg-secondary text-white
                        @elseif($order->status == 'shipped') bg-primary text-white
                        @elseif($order->status == 'delivered') bg-success text-white
                        @elseif($order->status == 'cancelled') bg-danger text-white
                        @else bg-light text-dark
                        @endif
                    ">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="order-item mb-4">
                    {{ $item->product->name ?? $item->product_name ?? '-' }}
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="text-muted">Total</span>
                    <span class="order-price">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </span>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('orders.show', $order) }}"
                       class="btn order-btn order-btn-primary w-100">
                        Detail
                    </a>

                    @if(Route::has('orders.invoice'))
                    <a href="{{ route('orders.invoice', $order) }}"
                       class="btn order-btn order-btn-outline w-100">
                        Invoice
                    </a>
                    @endif
                </div>

            </div>
        </div>
        @endforeach

    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>

    @else
    <div class="empty-state text-center">
        <h3 class="fw-bold mb-2">Belum Ada Pesanan</h3>
        <p class="text-muted mb-4">Mulai transaksi pertama kamu</p>
        <a href="{{ route('products.index') }}"
           class="btn order-btn order-btn-primary px-5 py-3">
            Mulai Belanja
        </a>
    </div>
    @endif

</div>
</div>
@endsection
