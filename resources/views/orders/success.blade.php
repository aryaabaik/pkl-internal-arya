@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h1 class="text-success fw-bold mb-3">
        Pembayaran Berhasil 🎉
    </h1>

    <p class="mb-4">
        Terima kasih! Pembayaran Anda sedang diverifikasi.
        Pesanan akan segera diproses.
    </p>

    <a href="{{ route('orders.index', $order) }}" class="btn btn-primary">
        Lihat Detail Pesanan
    </a>
</div>
@endsection
