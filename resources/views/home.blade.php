
@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    {{-- Hero Section - Lega, fokus teks + ilustrasi minimalist --}}
    <section class="hero-gradient text-white py-5 mb-5">
    <div class="container py-lg-5">
        <div class="row align-items-center gy-5">

            <!-- TEXT -->
            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge bg-light text-dark px-3 py-2 rounded-pill mb-3">
                    ✨ Belanja Praktis
                </span>

                <h1 class="display-4 fw-bold mb-4">
                    Belanja Online<br>
                    <span class="text-warning">Cepat, Mudah & Terpercaya</span>
                </h1>

                <p class="lead mb-5 opacity-90">
                    Temukan produk pilihan dengan kualitas terbaik.<br>
                    <strong>Gratis ongkir</strong> untuk pembelian pertama!
                </p>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('catalog.index') }}"
                       class="btn btn-light btn-lg px-5 py-3 rounded-pill shadow">
                        <i class="bi bi-bag me-2"></i>Mulai Belanja
                    </a>

                    <a href="#promo"
                       class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                        Lihat Promo
                    </a>
                </div>
            </div>

            <!-- IMAGE SLIDER -->
            <div class="col-lg-6" data-aos="fade-left">
                <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">

                    <div class="carousel-inner rounded-4 shadow-lg">

                        <div class="carousel-item active">
                            <img src="images/joko.jpeg"
                                 class="d-block w-100"
                                 style="max-height:420px; object-fit:cover;"
                                 alt="Belanja Online 1">
                        </div>

                        <div class="carousel-item">
                            <img src="images/8.jpg"
                                 class="d-block w-100"
                                 style="max-height:420px; object-fit:cover;"
                                 alt="Belanja Online 2">
                        </div>

                        <div class="carousel-item">
                            <img src="images/ribka.jfif"
                                 class="d-block w-100"
                                 style="max-height:420px; object-fit:cover;"
                                 alt="Belanja Online 3">
                        </div>

                    </div>

                    <!-- CONTROL -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>
<style>
.hero-gradient {
    background: linear-gradient(135deg, #1d2671, #c33764);
}

.carousel-inner img {
    transition: transform 0.6s ease;
}

.carousel-inner img:hover {
    transform: scale(1.03);
}
</style>

    {{-- Kategori Populer - Ikon lebih besar & rapi --}}
    <section class="py-6 py-lg-9 mb-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold display-6">Kategori Populer</h2>
            <div class="row g-4 justify-content-center">
                @foreach($categories as $category)
                    <div class="col-4 col-md-3 col-lg-2 text-center" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <a href="{{ route('catalog.index', ['category' => $category->slug]) }}"
                           class="text-decoration-none text-dark d-block">
                            <div class="mb-3 rounded-circle overflow-hidden border mx-auto shadow-sm"
                                 style="width: 110px; height: 110px; border-width: 3px !important;">
                                <img src="{{ $category->image_url }}"
                                     alt="{{ $category->name }}"
                                     class="img-fluid w-100 h-100"
                                     style="object-fit: cover; transition: transform 0.3s;">
                            </div>
                            <h6 class="mb-0 fw-semibold">{{ $category->name }}</h6>
                            <small class="text-muted ">{{ $category->products_count }} produk</small>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Produk Unggulan --}}
    <section class="py-6 py-lg-9 bg-light mb-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <h2 class="h3 fw-bold mb-0">Produk Unggulan</h2>
                <a href="{{ route('catalog.index') }}" class="text-primary fw-medium">Lihat Semua →</a>
            </div>
            <div class="row g-4 g-xl-5">
                @foreach($featuredProducts as $product)
                    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        @include('profile.partials.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Promo Banner - Soft & modern --}}
    <section class="py-6 py-lg-9 mb-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-md-6" data-aos="fade-right">
                        <div class="card border-0 h-100 rounded-4 shadow-sm p-5 p-lg-6 text-dark" style="background-color: #fffbeb;">
                        <h4     class="fw-bold mb-4 display-6">Flash Sale!</h4>
                        <p class="lead mb-5">Diskon hingga 50% untuk produk terpilih</p>
                        <a href="#" class="btn btn-dark rounded-pill px-5 py-3">Lihat Promo</a>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <div class="card border-0 h-100 rounded-4 shadow-sm p-5 p-lg-6 text-dark" style="background-color: #f0f9ff;">
                        <h4 class="fw-bold mb-4 display-6">Member Baru</h4>
                        <p class="lead mb-5">Dapatkan voucher Rp50.000 untuk pembelian pertama</p>
                        <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-5 py-3">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Produk Terbaru --}}
    <section class="py-6 py-lg-9">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold display-6">Produk Terbaru</h2>
            <div class="row g-4 g-xl-5">
                @foreach($latestProducts as $product)
                    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        @include('profile.partials.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

{{-- CSS Tambahan - Minimal & Clean --}}
@section('styles')
<style>
    section { 
        padding-top: 6rem !important; 
        padding-bottom: 6rem !important; 
    }
    @media (min-width: 992px) {
        section { 
            padding-top: 9rem !important; 
            padding-bottom: 9rem !important; 
        }
    }
    .card { transition: transform 0.3s ease; }
    .card:hover { transform: translateY(-8px); }
    a.text-dark:hover h6 { color: var(--bs-primary) !important; }
    img:hover { transform: scale(1.08); }
</style>
@endsection

{{-- AOS Animation --}}
@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        once: true,
        duration: 900,
        easing: 'ease-out-quart'
    });
</script>
@endpush