{{-- ================================================
     FILE: resources/views/partials/navbar.blade.php
     FUNGSI: Navigation bar customer - Dropdown SOLID WHITE + Animasi Super Smooth
     ================================================ --}}

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top" id="mainNavbar">
    <div class="container px-4 py-3">
        {{-- Logo --}}
        <a class="navbar-brand d-flex align-items-center text-decoration-none" href="{{ route('home') }}">
            <img src="images/8.jpg" 
                 alt="TokoOnline Logo" 
                 class="me-3" 
                 width="60" 
                 height="60"
                 style="object-fit: contain; border-radius: 12px; box-shadow: 0 4px 15px rgba(99,102,241,0.2);">
            <span class="fw-bold fs-3">Toko<span class="text-pink">Online</span></span>
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <i class="bi bi-list fs-3 text-dark"></i>
        </button>

        {{-- Navbar Content --}}
        <div class="collapse navbar-collapse" id="navbarMain">
            {{-- Search --}}
            <form class="mx-auto my-3 my-lg-0" style="max-width: 500px; width: 100%;" action="{{ route('catalog.index') }}" method="GET">
                <div class="position-relative">
                    <input type="text" name="q" class="form-control search-input ps-5 pe-4 py-3 rounded-pill border-0 shadow-sm"
                           placeholder="Cari produk, merek, atau kategori..." value="{{ request('q') }}">
                    <i class="bi bi-search position-absolute top-50 start-4 translate-middle-y text-muted fs-5"></i>
                    <button type="submit" class="btn btn-primary position-absolute top-50 end-0 translate-middle-y me-2 rounded-pill px-4">
                        Cari
                    </button>
                </div>
            </form>

            {{-- Right Menu --}}
            <ul class="navbar-nav ms-auto align-items-center gap-3">
                {{-- Katalog --}}
                <li class="nav-item">
                    <a class="nav-link modern-link d-flex align-items-center" href="{{ route('catalog.index') }}">
                        <i class="bi bi-grid-3x3-gap me-2 fs-5"></i>
                        <span class="d-none d-lg-inline">Katalog</span>
                    </a>
                </li>

                @auth
                    {{-- Wishlist --}}                    <li class="nav-item position-relative">
                        <a class="nav-link icon-link" href="{{ route('wishlist.index') }}">
                            <i class="bi bi-heart fs-4"></i>
                            @if(auth()->user()->wishlistProducts()->count() > 0)
                                <span class="badge-modern badge-wishlist">{{ auth()->user()->wishlistProducts()->count() }}</span>
                            @endif
                        </a>
                    </li>

                    {{-- Cart --}}
                    <li class="nav-item position-relative">
                        <a class="nav-link icon-link" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart3 fs-4"></i>
                            @php $cartCount = auth()->user()->cart?->items()->count() ?? 0; @endphp
                            @if($cartCount > 0)
                                <span class="badge-modern badge-cart">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>

                    {{-- User Dropdown - SUPER SOLID & SMOOTH SEKARANG! --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-decoration-none" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=6366f1&color=fff' }}"
                                 class="rounded-circle me-2 border-3 border-indigo" width="40" height="40" alt="Avatar">
                            <span class="fw-medium d-none d-lg-inline">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end modern-dropdown-solid shadow-xl border-0 py-4 px-2" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item premium-item py-3 px-4 rounded" href="{{ route('profile.edit') }}"><i class="bi bi-person me-3"></i>Profil Saya</a></li>
                            <li><a class="dropdown-item premium-item py-3 px-4 rounded" href="{{ route('orders.index') }}"><i class="bi bi-bag me-3"></i>Pesanan Saya</a></li>
                            @if(auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider my-3 mx-3 opacity-50"></li>
                                <li><a class="dropdown-item premium-item py-3 px-4 rounded text-primary fw-bold" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-3"></i>Admin Panel</a></li>
                            @endif
                            <li><hr class="dropdown-divider my-3 mx-3 opacity-50"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item premium-item py-3 px-4 rounded text-danger w-100 text-start"><i class="bi bi-box-arrow-right me-3"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link modern-link" href="{{ route('login') }}">Masuk</a></li>
                    <li class="nav-item">
                        <a class="btn btn-primary rounded-pill px-4 py-2 shadow modern-btn" href="{{ route('register') }}">Daftar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    /* DROPDOWN KHUSUS: SOLID WHITE + ANIMASI BUTTERY SMOOTH */
    .modern-dropdown-solid {
        background-color: #ffffff !important; /* 100% solid white */
        border-radius: 1.25rem !important;
        margin-top: 0.75rem;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-15px);
        transition: all 0.35s ease-out;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.18) !important; /* Shadow lebih dalam */
        min-width: 240px;
    }

    .dropdown:hover > .modern-dropdown-solid,
    .dropdown.show > .modern-dropdown-solid {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .premium-item {
        transition: all 0.3s ease-in-out;
        margin: 0.25rem 0;
    }

    .premium-item:hover {
        background-color: #f0f4ff !important;
        transform: translateX(10px) scale(1.03);
        color: #6366f1 !important;
    }

    /* Sisanya (navbar lain) tetap sama */
    #mainNavbar { transition: all 0.4s ease; backdrop-filter: blur(10px); }
    #mainNavbar.scrolled { background-color: rgba(255, 255, 255, 0.95) !important; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); }
    .search-input { background-color: #f8f9fa; transition: all 0.3s ease; }
    .search-input:focus { background-color: #fff; box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25); transform: scale(1.02); }
    .modern-link { font-weight: 500; color: #4b5563; transition: all 0.3s ease; padding: 0.5rem 1rem !important; border-radius: 0.75rem; }
    .modern-link:hover { color: #6366f1; background-color: #eef2ff; transform: translateY(-2px); }
    .icon-link { font-size: 1.5rem; color: #4b5563; transition: all 0.3s ease; padding: 0.5rem; border-radius: 50%; }
    .icon-link:hover { color: #6366f1; background-color: #eef2ff; transform: scale(1.15); }
    .badge-modern { position: absolute; top: -8px; right: -8px; font-size: 0.65rem; font-weight: bold; min-width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; animation: pulse 2s infinite; }
    .badge-wishlist { background-color: #ef4444; color: white; }
    .badge-cart { background-color: #6366f1; color: white; }
    @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.1); } 100% { transform: scale(1); } }
    .modern-btn { transition: all 0.3s ease; }
    .modern-btn:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3); }
    .text-pink { color: #00d9ff; }
    .border-indigo { border-color: #6366f1 !important; }
</style>

<script>
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('mainNavbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>