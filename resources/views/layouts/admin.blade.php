{{-- ================================================
    FILE: resources/views/layouts/admin.blade.php
    FUNGSI: Master layout untuk halaman admin (Playful School Theme)
================================================ --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - SudiaShop Admin</title>

    {{-- Google Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* =========================
           GLOBAL
        ========================== */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8f9fc;
            color: #1e1b4b;
        }
        a { text-decoration: none; }

        /* =========================
           SIDEBAR
        ========================== */
        .sidebar {
            min-height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, #7c3aed 0%, #9333ea 100%);
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 15px rgba(0,0,0,0.05);
            transition: width 0.3s;
        }

        .sidebar .brand {
            padding: 1.2rem 1rem;
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 0.85rem 1rem;
            margin: 6px 12px;
            color: rgba(255,255,255,0.85);
            border-radius: 12px;
            transition: all 0.25s;
            gap: 0.5rem;
            font-weight: 500;
        }
        .sidebar .nav-link i {
            font-size: 1.3rem;
            width: 28px;
        }
        .sidebar .nav-link.active, 
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.2);
            color: #fff;
            transform: translateX(4px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Badge Gradient */
        .badge-gradient {
            background: linear-gradient(45deg, #facc15, #f97316);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 999px;
            padding: 0.25rem 0.5rem;
            animation: pulse 1.8s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        /* Sidebar Footer / User Info */
        .sidebar-footer {
            margin-top: auto;
            padding: 1rem;
            border-top: 1px solid rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
            color: #fff;
        }
        .sidebar-footer:hover {
            background: rgba(255,255,255,0.1);
        }

        /* =========================
           TOP BAR
        ========================== */
        header {
            background-color: #fff;
            padding: 0.75rem 1.5rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        header h4 { font-weight: 600; color: #1e1b4b; }

        /* =========================
           MAIN CONTENT
        ========================== */
        main {
            padding: 2rem 1.5rem;
            background: #f5f5f9;
            min-height: 100vh;
        }

        /* FLASH MESSAGE */
        .alert { border-radius: 12px; font-size: 0.9rem; }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .sidebar { position: fixed; z-index: 100; left: -280px; }
            .sidebar.show { left: 0; }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="sidebar d-flex flex-column">
            {{-- Brand --}}
            <div class="brand">
                <i class="bi bi-pencil-square fs-3"></i>
                <span>SudiaShop</span>
            </div>

            {{-- Navigation --}}
            <nav class="flex-grow-1 py-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2 text-info"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}"
                           class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam text-success"></i> Produk
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}"
                           class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="bi bi-folder text-warning"></i> Kategori
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}"
                           class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <i class="bi bi-bag-check text-danger"></i> Pesanan
                            @php
                                $pendingCount = \App\Models\Order::where('status', 'pending')->count();
                            @endphp
                            @if($pendingCount > 0)
                                <span class="badge-gradient ms-auto">{{ $pendingCount }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="nav-item mt-3">
                        <span class="nav-link text-muted small text-uppercase">Laporan</span>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.reports.sales') }}"
                           class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                            <i class="bi bi-graph-up text-primary"></i> Laporan Penjualan
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- Sidebar Footer / User Info --}}
            <a href="{{ route('profile.edit') }}">
                <div class="sidebar-footer">
                    <img src="{{ auth()->user()->avatar_url }}" class="rounded-circle" width="36" height="36">
                    <div>
                        <div class="fw-medium">{{ auth()->user()->name }}</div>
                        <div class="small">Administrator</div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Main Content --}}
        <div class="flex-grow-1 d-flex flex-column">
            {{-- Top Bar --}}
            <header>
                <h4>@yield('page-title', 'Dashboard')</h4>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm" target="_blank">
                        <i class="bi bi-box-arrow-up-right"></i> Lihat Toko
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </header>

            {{-- Flash Messages --}}
            <div class="px-4 pt-3">
                @include('profile.partials.flash-messages')
            </div>

            {{-- Page Content --}}
            <main>
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
