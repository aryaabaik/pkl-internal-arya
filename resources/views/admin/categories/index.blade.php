{{-- resources/views/admin/categories/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="row mb-3">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h5 class="text-primary fw-bold">Daftar Kategori</h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="bi bi-plus-lg"></i> Tambah Baru
        </button>
    </div>
</div>

{{-- Search & Filter --}}
<div class="row mb-3">
    <div class="col-md-6 mb-2 mb-md-0">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari kategori...">
    </div>
    <div class="col-md-3">
        <select id="filterStatus" class="form-select">
            <option value="">Semua Status</option>
            <option value="1">Aktif</option>
            <option value="0">Non-Aktif</option>
        </select>
    </div>
</div>

{{-- Desktop Table --}}
<div class="d-none d-md-block">
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Nama Kategori</th>
                            <th class="text-center">Produk</th>
                            <th class="text-center">Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="categoryTable">
                        @forelse($categories as $category)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        @if($category->image)
                                            <img src="{{ url('storage/' . $category->image) }}" class="rounded me-2" width="40" height="40">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold">{{ $category->name }}</div>
                                            <small class="text-muted">{{ $category->slug }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pulse text-white" style="background: linear-gradient(90deg, #6d28d9, #9333ea);">{{ $category->products_count }} <i class="bi bi-book"></i></span>
                                </td>
                                <td class="text-center">
                                    @if($category->is_active)
                                        <span class="badge badge-pulse text-white" style="background: linear-gradient(90deg, #7c3aed, #a855f7);">Aktif</span>
                                    @else
                                        <span class="badge badge-pulse text-white" style="background: linear-gradient(90deg, #4b5563, #6b7280);">Non-Aktif</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-outline-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $categories->links() }}
        </div>
    </div>
</div>

{{-- Mobile Card View --}}
<div class="d-md-none">
    <div class="row" id="categoryCardContainer">
        @forelse($categories as $category)
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            @if($category->image)
                                <img src="{{ url('storage/' . $category->image) }}" class="rounded me-3" width="50" height="50">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                            <div>
                                <div class="fw-bold">{{ $category->name }}</div>
                                <small class="text-muted">{{ $category->slug }}</small>
                                <div class="mt-1">
                                    <span class="badge badge-pulse text-white" style="background: linear-gradient(90deg, #6d28d9, #9333ea);">{{ $category->products_count }} <i class="bi bi-book"></i></span>
                                    @if($category->is_active)
                                        <span class="badge badge-pulse text-white" style="background: linear-gradient(90deg, #7c3aed, #a855f7);">Aktif</span>
                                    @else
                                        <span class="badge badge-pulse text-white" style="background: linear-gradient(90deg, #4b5563, #6b7280);">Non-Aktif</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-outline-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-4">Belum ada kategori.</div>
        @endforelse
    </div>
</div>

{{-- MODAL CREATE --}}
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <form class="modal-content" action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required placeholder="Misal: Elektronik">
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar Cover</label>
                    <input type="file" name="image" class="form-control" onchange="previewImage(event, 'previewCreate')">
                    <img id="previewCreate" class="img-thumbnail rounded mt-2 d-none" width="60">
                </div>
                <div class="form-check form-switch">
                    {{-- Hidden input untuk default 0 --}}
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                    <label class="form-check-label">Langsung Aktifkan</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
@foreach($categories as $category)
<div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <form class="modal-content" action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori: {{ $category->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar (Opsional)</label>
                    @if($category->image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($category->image) }}" id="previewEdit{{ $category->id }}" width="60" class="img-thumbnail rounded">
                        </div>
                    @else
                        <img id="previewEdit{{ $category->id }}" class="img-thumbnail rounded d-none" width="60">
                    @endif
                    <input type="file" name="image" class="form-control" onchange="previewImage(event, 'previewEdit{{ $category->id }}')">
                </div>
                <div class="form-check form-switch">
                    {{-- Hidden input untuk default 0 --}}
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }}>
                    <label class="form-check-label">Aktif</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endforeach

@endsection

@push('styles')
<style>
/* Badge pulse animation */
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
// Image preview
function previewImage(event, previewId) {
    const input = event.target;
    const preview = document.getElementById(previewId);
    if(input.files && input.files[0]){
        preview.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('d-none');
    }
}

// Search & filter
const searchInput = document.getElementById('searchInput');
const filterStatus = document.getElementById('filterStatus');
const tableBody = document.getElementById('categoryTable');
const cardContainer = document.getElementById('categoryCardContainer');

function filterCategories() {
    const search = searchInput.value.toLowerCase();
    const status = filterStatus.value;

    // Table desktop
    Array.from(tableBody.rows).forEach(row => {
        const name = row.cells[0].innerText.toLowerCase();
        const stat = row.cells[2].innerText.toLowerCase() === 'aktif' ? '1' : '0';
        const matchesSearch = name.includes(search);
        const matchesStatus = !status || stat === status;
        row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
    });

    // Mobile cards
    Array.from(cardContainer.children).forEach(card => {
        const name = card.querySelector('.fw-bold').innerText.toLowerCase();
        const statBadge = card.querySelectorAll('.badge')[1];
        const stat = statBadge ? (statBadge.innerText.toLowerCase() === 'aktif' ? '1' : '0') : '1';
        const matchesSearch = name.includes(search);
        const matchesStatus = !status || stat === status;
        card.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
    });
}

searchInput.addEventListener('input', filterCategories);
filterStatus.addEventListener('change', filterCategories);
</script>
@endpush
