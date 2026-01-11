@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 fw-bold text-purple">Daftar Pesanan</h2>
</div>

<div class="card shadow-sm border-0">
    {{-- Card Header dengan Filter --}}
    <div class="card-header bg-purple-gradient text-white py-3">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link {{ !request('status') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">Semua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'pending']) }}">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('status') == 'processing' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'processing']) }}">Diproses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('status') == 'completed' ? 'active' : '' }}" href="{{ route('admin.orders.index', ['status' => 'completed']) }}">Selesai</a>
            </li>
        </ul>
    </div>

    {{-- Card Body --}}
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-purple-gradient text-white">
                    <tr>
                        <th class="ps-4">No. Order</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4 fw-bold text-purple">#{{ $order->order_number }}</td>
                        <td>
                            <div class="fw-bold">{{ $order->user->name }}</div>
                            <small class="text-muted">{{ $order->user->email }}</small>
                        </td>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td class="fw-bold text-dark">Rp {{ number_format($order->total_amount,0,',','.') }}</td>
                        <td>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-warning text-dark shadow-sm',
                                    'processing' => 'bg-info text-white shadow-sm',
                                    'completed' => 'bg-success text-white shadow-sm',
                                    'cancelled' => 'bg-danger text-white shadow-sm',
                                ];
                            @endphp
                            <span class="badge {{ $statusColors[$order->status] ?? 'bg-secondary' }} px-3 py-2 rounded-pill">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="btn btn-sm btn-purple-gradient text-white fw-bold shadow-sm">
                                <i class="bi bi-eye me-1"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Tidak ada pesanan ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Card Footer --}}
    <div class="card-footer bg-light">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- Custom CSS --}}
@push('styles')
<style>
    .text-purple { color: #7c3aed !important; }
    .bg-purple-gradient {
        background: linear-gradient(135deg,#7c3aed,#a78bfa) !important;
    }
    .btn-purple-gradient {
        background: linear-gradient(135deg,#7c3aed,#a78bfa);
        transition: all 0.3s;
    }
    .btn-purple-gradient:hover {
        box-shadow: 0 4px 15px rgba(124,58,237,0.4);
        transform: translateY(-2px);
    }

    /* Table head ungu */
    .table thead.bg-purple-gradient th {
        border: none;
        font-weight: 600;
    }
</style>
@endpush
@endsection
