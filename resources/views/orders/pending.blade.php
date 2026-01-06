@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h1 class="text-warning fw-bold mb-3">
        Menunggu Pembayaran ⏳
    </h1>

    <p class="mb-4">
        Silakan selesaikan pembayaran Anda.
        Status akan diperbarui otomatis.
    </p>

    <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">
        Kembali ke Pesanan
    </a>
</div>
@endsection
