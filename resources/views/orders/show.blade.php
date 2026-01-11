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
.order-show {
    background: #f6f7fb;
}

/* CARD */
.order-panel {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
}

/* HEADER */
.order-header {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-title {
    font-weight: 800;
    font-size: 1.1rem;
}

/* STATUS */
.order-status {
    font-size: 11px;
    padding: 6px 14px;
    border-radius: 999px;
    font-weight: 700;
    text-transform: uppercase;
}

/* SECTION */
.order-section {
    padding: 24px;
    border-bottom: 1px solid var(--border);
}

.order-section:last-child {
    border-bottom: none;
}

/* TABLE */
.table th {
    font-size: .8rem;
    text-transform: uppercase;
    letter-spacing: .04em;
    color: var(--muted);
}

.table td {
    vertical-align: middle;
}

/* TOTAL */
.order-total {
    font-size: 1.3rem;
    font-weight: 900;
    color: var(--primary);
}

/* ADDRESS */
.address-box {
    background: var(--bg-soft);
    border-radius: 12px;
    padding: 16px;
    border: 1px solid var(--border);
}

/* ACTION */
.order-action {
    padding: 24px;
    text-align: center;
}

.order-action .btn-primary {
    padding: 14px;
    font-weight: 700;
    border-radius: 12px;
    background: var(--primary);
    border: none;
}

.order-action .btn-primary:hover {
    background: #4338ca;
}
</style>

<div class="order-show py-5">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-8">

<div class="order-panel">

    {{-- HEADER --}}
    <div class="order-header">
        <div>
            <div class="order-title">
                Pesanan #{{ $order->order_number }}
            </div>
            <small class="text-muted">
                {{ $order->created_at->format('d M Y • H:i') }}
            </small>
        </div>

        <span class="order-status
            @if($order->status == 'pending') bg-warning text-dark
            @elseif($order->status == 'success') bg-success text-white
            @else bg-secondary text-white
            @endif
        ">
            {{ strtoupper($order->status) }}
        </span>
    </div>

    {{-- ITEMS --}}
    <div class="order-section">
        <h6 class="fw-bold mb-3">Produk Dipesan</h6>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Harga</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-end">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                        <td class="text-end fw-bold">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    @if($order->shipping_cost > 0)
                    <tr>
                        <td colspan="3" class="text-end text-muted">
                            Ongkos Kirim
                        </td>
                        <td class="text-end">
                            Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="3" class="text-end fw-bold">
                            Total Bayar
                        </td>
                        <td class="text-end order-total">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- ADDRESS --}}
    <div class="order-section">
        <h6 class="fw-bold mb-2">Alamat Pengiriman</h6>
        <div class="address-box">
            <div class="fw-semibold">{{ $order->shipping_name }}</div>
            <div class="text-muted">{{ $order->shipping_phone }}</div>
            <div class="text-muted">{{ $order->shipping_address }}</div>
        </div>
    </div>

    {{-- ACTION --}}
    <div class="order-action">
        @if($order->payment_status !== 'paid')
        <button
            class="btn btn-primary w-100"
            id="pay-button"
            data-order-id="{{ $order->id }}">
            Bayar Sekarang
        </button>
        @endif

        <a href="{{ route('orders.index') }}"
           class="d-inline-block mt-3 text-muted text-decoration-none">
            ← Kembali ke Daftar Pesanan
        </a>
    </div>

</div>
</div>
</div>
</div>
</div>

{{-- MIDTRANS --}}
@if($order->payment_status !== 'paid')
@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.getElementById('pay-button')?.addEventListener('click', function () {
    fetch("{{ route('payment.snap', $order) }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (!data.token) {
            alert('Gagal mendapatkan token pembayaran');
            return;
        }

        snap.pay(data.token, {
            onSuccess: function () {
                window.location.href = "{{ url('/orders/success') }}/" + data.order_id;
            },
            onPending: function () {
                window.location.href = "{{ url('/orders/pending') }}/" + data.order_id;
            },
            onError: function () {
                alert('Pembayaran gagal');
            }
        });
    });
});
</script>
@endpush
@endif

@endsection
