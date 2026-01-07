{{-- ================================================
     FILE: resources/views/partials/navbar.blade.php
     FUNGSI: Luxury Solid Navbar - Nama User Muncul & Modern Design
     ================================================ --}}

<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm" id="mainNavbar">
    <div class="container py-2">
        {{-- Logo --}}
        <a class="navbar-brand d-flex align-items-center text-decoration-none" href="{{ route('home') }}">
            <div class="logo-box me-2">
                <img src="images/8.jpg" alt="Logo">
            </div>
            <span class="brand-name">Toko<span class="text-accent-blue">Online</span></span>
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <i class="bi bi-list fs-2"></i>
        </button>

        {{-- Navbar Content --}}
        <div class="collapse navbar-collapse" id="navbarMain">
            {{-- Menu Tengah (Katalog dll) --}}
            <ul class="navbar-nav mx-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('catalog.index') }}">Katalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">Terbaru</a>
                </li>
            </ul>

            {{-- Menu Kanan (Ikon & Profil) --}}
            <ul class="navbar-nav align-items-center gap-3">
                @auth
                    {{-- Wishlist --}}
                    <li class="nav-item">
                        <a class="nav-icon" href="{{ route('wishlist.index') }}" title="Wishlist">
                            <i class="bi bi-heart"></i>
                            @if(auth()->user()->wishlistProducts()->count() > 0)
                                <span class="badge-custom bg-danger"></span>
                            @endif
                        </a>
                    </li>

                    {{-- Cart --}}
                    <li class="nav-item">
                        <a class="nav-icon" href="{{ route('cart.index') }}" title="Keranjang">
                            <i class="bi bi-bag"></i>
                            @php $cartCount = auth()->user()->cart?->items()->count() ?? 0; @endphp
                            @if($cartCount > 0)
                                <span class="badge-number-v2">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>

                    {{-- User Dropdown dengan Nama --}}
                    <li class="nav-item dropdown ms-lg-2">
                        <a class="nav-link profile-pill d-flex align-items-center gap-2" href="#" id="userDropdown" data-bs-toggle="dropdown">
                            <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=7c3aed&color=fff' }}"
                                 alt="User">
                            <span class="user-name-text d-none d-lg-inline">{{ auth()->user()->name }}</span>
                            <i class="bi bi-chevron-down small opacity-50 d-none d-lg-inline"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end modern-dropdown-v2 shadow border-0" aria-labelledby="userDropdown">
                            <div class="px-4 py-3 bg-light-purple mb-2 rounded-top">
                                <p class="mb-0 fw-bold text-dark small">Halo, Selamat Datang!</p>
                                <p class="mb-0 text-muted extra-small">{{ auth()->user()->email }}</p>
                            </div>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person-circle me-2"></i>Akun Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i class="bi bi-box-seam me-2"></i>Riwayat Pesanan</a></li>
                            @if(auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-primary fw-600" href="{{ route('admin.dashboard') }}"><i class="bi bi-cpu me-2"></i>Admin Dashboard</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-power me-2"></i>Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link menu-link" href="{{ route('login') }}">Masuk</a></li>
                    <li class="nav-item">
                        <a class="btn btn-purple-solid rounded-pill px-4" href="{{ route('register') }}">Daftar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    /* KONFIGURASI TEMA */
    :root {
        --p-purple: #7c3aed;
        --s-purple: #f5f3ff;
        --dark-navy: #1e1b4b;
        --accent-blue: #00d9ff;
    }

    /* NAVBAR BASE */
    #mainNavbar {
        background: #ffffff !important;
        border-bottom: 1px solid #f1f5f9;
        transition: 0.3s;
    }

    .logo-box {
        width: 48px;
        height: 48px;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.1);
    }
    .logo-box img { width: 100%; height: 100%; object-fit: cover; }

    .brand-name { font-weight: 800; font-size: 1.4rem; color: var(--dark-navy); letter-spacing: -0.5px; }
    .text-accent-blue { color: var(--accent-blue); }

    /* MENU TENGAH */
    .menu-link {
        font-weight: 600;
        color: #64748b !important;
        padding: 0.5rem 1.2rem !important;
        transition: 0.3s ease;
    }
    .menu-link:hover { color: var(--p-purple) !important; }

    /* IKON NAVIGASI */
    .nav-icon {
        font-size: 1.4rem;
        color: #64748b;
        position: relative;
        display: flex;
        padding: 8px;
        border-radius: 12px;
        transition: 0.3s;
    }
    .nav-icon:hover { background: var(--s-purple); color: var(--p-purple); }

    .badge-custom {
        position: absolute;
        top: 10px; right: 10px;
        width: 8px; height: 8px;
        border-radius: 50%;
        border: 2px solid white;
    }

    .badge-number-v2 {
        position: absolute;
        top: 2px; right: 2px;
        background: var(--p-purple);
        color: white; font-size: 0.65rem; font-weight: 800;
        padding: 2px 6px; border-radius: 20px;
        border: 2px solid white;
    }

    /* PROFILE PILL */
    .profile-pill {
        background: #f8fafc;
        padding: 6px 16px 6px 8px !important;
        border-radius: 100px;
        border: 1px solid #f1f5f9;
        transition: 0.3s;
    }
    .profile-pill:hover { background: #f1f5f9; border-color: #e2e8f0; }
    .profile-pill img { width: 34px; height: 34px; border-radius: 50%; object-fit: cover; }
    .user-name-text { font-size: 0.9rem; font-weight: 700; color: var(--dark-navy); }

    /* DROPDOWN */
    .modern-dropdown-v2 {
        border-radius: 16px;
        min-width: 240px;
        margin-top: 12px !important;
        padding: 0;
        overflow: hidden;
    }
    .bg-light-purple { background: var(--s-purple); }
    .dropdown-item {
        padding: 10px 20px;
        font-size: 0.9rem;
        font-weight: 500;
        color: #475569;
    }
    .dropdown-item:hover {
        background: var(--s-purple);
        color: var(--p-purple);
        padding-left: 25px;
    }
    .extra-small { font-size: 0.75rem; }

    /* BUTTONS */
    .btn-purple-solid {
        background: var(--p-purple);
        color: white;
        font-weight: 700;
        border: none;
        transition: 0.3s;
    }
    .btn-purple-solid:hover {
        background: #6d28d9;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(124, 58, 237, 0.25);
    }

    @media (max-width: 991.98px) {
        .navbar-collapse { padding: 20px 0; }
        .profile-pill { margin-top: 15px; }
    }
</style>