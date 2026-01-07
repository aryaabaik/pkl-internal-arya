@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card border-0 shadow-lg text-center p-4 p-md-5"
                 style="border-radius: 20px; background: linear-gradient(135deg, #e3f2fd, #fff);">

                {{-- Icon --}}
                <div class="mb-4">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                         style="width: 90px; height: 90px; background: #d1fae5;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46"
                             fill="#22c55e" viewBox="0 0 24 24">
                            <path d="M20.285 6.709l-11.025 11.025-5.545-5.545 1.414-1.414 4.131 4.131 9.611-9.611z"/>
                        </svg>
                    </div>
                </div>

                {{-- Title --}}
                <h1 class="fw-bold text-success mb-3">
                    Pembayaran Berhasil!
                </h1>

                {{-- Subtitle --}}
                <p class="text-muted mb-4" style="font-size: 1.05rem;">
                    Terima kasih telah berbelanja di  
                    <span class="fw-semibold text-primary">TokoAlatSekolah</span> 📚✏️  
                    <br>
                    Pembayaran Anda sedang diverifikasi dan pesanan akan segera diproses.
                </p>

                {{-- Info Box --}}
                <div class="alert alert-success small mb-4"
                     style="border-radius: 12px;">
                    💡 <strong>Tips:</strong> Anda bisa memantau status pesanan
                    secara real-time di halaman detail pesanan.
                </div>

                {{-- Buttons --}}
                <div class="d-grid gap-3">
                    <a href="{{ route('orders.show', $order->id) }}"
                       class="btn btn-primary btn-lg"
                       style="border-radius: 12px;">
                        📦 Lihat Detail Pesanan
                    </a>

                    <a href="{{ route('products.index') }}"
                       class="btn btn-outline-secondary"
                       style="border-radius: 12px;">
                        🛒 Lanjut Belanja Alat Sekolah
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
