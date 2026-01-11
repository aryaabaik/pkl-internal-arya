{{-- resources/views/admin/products/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 text-gray-800">Daftar Produk</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>
</div>

{{-- Filter --}}
<div class="row g-2 mb-4">
    <div class="col-md-4">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari produk..."
            value="{{ request('search') }}">
    </div>
    <div class="col-md-4">
        <select id="filterCategory" class="form-select">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category')==$category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-outline-secondary w-100" id="filterBtn">Filter</button>
    </div>
</div>

{{-- Desktop Table --}}
<div class="d-none d-md-block">
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="productTable">
                <thead class="table-light">
                    <tr>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr class="align-middle">
                        <td>
                            <img src="{{ $product->primaryImage?->image_url ?? asset('img/no-image.png') }}" 
                                 class="rounded shadow-sm" width="60" height="60" style="object-fit: cover;">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td class="fw-bold text-primary">Rp {{ number_format($product->price) }}</td>
                        <td>
                            <span class="badge bg-info text-dark">{{ $product->stock }}</span>
                        </td>
                        <td>
                            @if($product->is_active)
                                <span class="badge badge-pulse text-white" style="background: linear-gradient(90deg,#7c3aed,#a855f7)">Aktif</span>
                            @else
                                <span class="badge badge-pulse text-white" style="background: linear-gradient(90deg,#4b5563,#6b7280)">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-info mb-1">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning mb-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline mb-1" onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Data produk kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Mobile Card View --}}
<div class="d-md-none">
    <div class="row" id="productCardContainer">
        @forelse($products as $product)
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="{{ $product->primaryImage?->image_url ?? asset('img/no-image.png') }}" 
                                 class="rounded shadow-sm me-3" width="60" height="60" style="object-fit: cover;">
                            <div>
                                <div class="fw-bold">{{ $product->name }}</div>
                                <small class="text-muted">{{ $product->category->name }}</small>
                                <div class="mt-1">
                                    <span class="fw-bold text-primary">Rp {{ number_format($product->price) }}</span>
                                    <span class="badge bg-info text-dark ms-1">{{ $product->stock }}</span>
                                    @if($product->is_active)
                                        <span class="badge badge-pulse text-white" style="background: linear-gradient(90deg,#7c3aed,#a855f7)">Aktif</span>
                                    @else
                                        <span class="badge badge-pulse text-white" style="background: linear-gradient(90deg,#4b5563,#6b7280)">Nonaktif</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-info mb-1">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning mb-1">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline mb-1" onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-4">Data produk kosong</div>
        @endforelse
    </div>
</div>

<div class="mt-3">
    {{ $products->links('pagination::bootstrap-5') }}
</div>
@endsection

@push('styles')
<style>
/* Hover table row effect */
table#productTable tbody tr:hover {
    background: rgba(124, 58, 237, 0.05);
}

/* Badge pulse */
.badge-pulse {
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.05); opacity: 0.85; }
}
</style>
@endpush

@push('scripts')
<script>
// Live filter/search
const searchInput = document.getElementById('searchInput');
const filterCategory = document.getElementById('filterCategory');
const filterBtn = document.getElementById('filterBtn');

filterBtn.addEventListener('click', function(e){
    e.preventDefault();
    let search = searchInput.value;
    let category = filterCategory.value;
    let url = new URL(window.location.href);
    url.searchParams.set('search', search);
    url.searchParams.set('category', category);
    window.location.href = url;
});
</script>
@endpush
