{{-- resources/views/admin/products/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Detail Produk')

@section('content')
<div class="row">
    <div class="col-12">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold text-primary">
                <i class="bi bi-eye me-1"></i> Detail Produk
            </h2>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning text-white">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                </a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row g-4">

            {{-- IMAGES --}}
            <div class="col-lg-5 d-flex">
                <div class="card shadow-sm border-0 w-100 h-100">
                    <div class="card-body p-3 d-flex flex-column">

                        {{-- Primary Image --}}
                        <div class="mb-3 flex-shrink-0">
                            <img src="{{ asset('storage/'.$product->primaryImage?->image_path ?? 'img/no-image.png') }}"
                                 class="img-fluid rounded w-100" style="object-fit:cover; max-height:320px;">
                        </div>

                        {{-- Gallery Thumbnails --}}
                        <div class="d-flex gap-2 flex-wrap mt-auto">
                            @foreach($product->images as $image)
                            <img src="{{ asset('storage/'.$image->image_path) }}"
                                 class="rounded border" style="width:70px;height:70px;object-fit:cover;">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- PRODUCT INFO --}}
            <div class="col-lg-7 d-flex">
                <div class="card shadow-sm border-0 w-100 h-100">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">

                        <div>
                            {{-- Nama & Kategori --}}
                            <h3 class="fw-bold mb-1">{{ $product->name }}</h3>
                            <p class="text-muted mb-3"><i class="bi bi-tags me-1"></i>{{ $product->category->name }}</p>

                            {{-- Harga --}}
                            <div class="mb-3">
                                @if($product->discount_price)
                                    <h4 class="text-danger fw-bold d-inline">Rp {{ number_format($product->discount_price,0,',','.') }}</h4>
                                    <span class="text-muted fs-6 text-decoration-line-through ms-2">Rp {{ number_format($product->price,0,',','.') }}</span>
                                @else
                                    <h4 class="text-primary fw-bold">Rp {{ number_format($product->price,0,',','.') }}</h4>
                                @endif
                            </div>

                            {{-- Badges --}}
                            <div class="mb-3 d-flex gap-2">
                                <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                                @if($product->is_featured)
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-star-fill me-1"></i> Unggulan
                                </span>
                                @endif
                            </div>

                            {{-- Deskripsi --}}
                            <div class="card mb-3 shadow-sm p-3 border-0 bg-light">
                                <h6 class="fw-semibold text-muted mb-2">Deskripsi Produk</h6>
                                <p class="mb-0">{{ $product->description ?: '-' }}</p>
                            </div>

                            {{-- Meta Info --}}
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <div class="card shadow-sm p-3 border-0 text-center">
                                        <i class="bi bi-box-seam fs-3 text-secondary"></i>
                                        <div class="fw-semibold mt-1">Stok</div>
                                        <div>{{ $product->stock }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card shadow-sm p-3 border-0 text-center">
                                        <i class="bi bi-weight fs-3 text-secondary"></i>
                                        <div class="fw-semibold mt-1">Berat</div>
                                        <div>{{ $product->weight }} gram</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card shadow-sm p-3 border-0 text-center">
                                        <i class="bi bi-calendar fs-3 text-secondary"></i>
                                        <div class="fw-semibold mt-1">Dibuat</div>
                                        <div>{{ $product->created_at->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ACTIONS --}}
                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning text-white">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
