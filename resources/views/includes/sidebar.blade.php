<aside class="sidebar">

    <!-- BRAND -->
    <div class="brand">
        <div class="brand-icon">
            <i class="bx bx-library"></i>
        </div>
        <span class="brand-title">Perpustakaan</span>
    </div>

    <ul class="menu-list">

        <!-- Dashboard -->
        <p class="menu-label">Dashboard</p>
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="bx bx-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Kategori -->
        <p class="menu-label">Kategori Buku</p>
        <li class="menu-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
            <a href="kategori" class="menu-link">
                <i class="bx bx-category"></i>
                <span>Kategori Buku</span>
            </a>
        </li>

        <!-- Pengarang -->
        <p class="menu-label">Pengarang</p>
        <li class="menu-item {{ request()->routeIs('pengarang.*') ? 'active' : '' }}">
            <a href="pengarang" class="menu-link">
                <i class="bx bx-user"></i>
                <span>Pengarang Buku</span>
            </a>
        </li>

        <!-- Buku -->
        <p class="menu-label">Buku</p>
        <li class="menu-item {{ request()->routeIs('buku.*') ? 'active' : '' }}">
            <a href="buku" class="menu-link">
                <i class="bx bx-book"></i>
                <span>Buku</span>
            </a>
        </li>

        <!-- Peminjaman -->
        <p class="menu-label">Peminjaman</p>
        <li class="menu-item {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
            <a href="peminjaman" class="menu-link">
                <i class="bx bx-book-reader"></i>
                <span>Peminjaman</span>
            </a>
        </li>

        <!-- Laporan -->
        <p class="menu-label">Laporan</p>
        <li class="menu-item {{ request()->routeIs('report.*') ? 'active' : '' }}">
            <a href="" class="menu-link">
                <i class="bx bx-file"></i>
                <span>Laporan</span>
            </a>
        </li>

    </ul>

    <div class="sidebar-footer">
        <span>✨ Perpustakaan ✨</span>
    </div>

</aside>

<style>
/* ================================================
   SIDEBAR STYLE — SNEAT PRO MAX 2025
   ================================================ */

body {
    margin: 0;
    font-family: 'Inter', sans-serif;
}

/* SIDEBAR WRAPPER */
.sidebar {
    width: 270px;
    height: 100vh;
    background: #ffffff;
    position: fixed;
    top: 0;
    left: 0;
    padding: 28px 22px;
    border-right: 1px solid #e5e7eb;
    box-shadow: 2px 0 25px rgba(0,0,0,0.06);
    border-radius: 0 18px 18px 0;
    overflow-y: auto;
    animation: slideIn 0.35s ease-out;
}

@keyframes slideIn {
    from { opacity: 0; transform: translateX(-20px); }
    to   { opacity: 1; transform: translateX(0); }
}

/* BRAND */
.brand {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 35px;
}

.brand-icon {
    width: 48px;
    height: 48px;
    background: #eef0ff;
    border: 1px solid #dcdfff;
    border-radius: 14px;
    display: grid;
    place-items: center;
}

.brand-icon i {
    font-size: 26px;
    color: #4f46e5;
}

.brand-title {
    font-size: 22px;
    font-weight: 700;
    color: #4f46e5;
}

/* MENU LABEL */
.menu-label {
    font-size: 11px;
    text-transform: uppercase;
    color: #6f70ad;
    margin: 20px 0 10px;
    padding-left: 4px;
    font-weight: 600;
    opacity: 0.7;
}

/* MENU ITEM */
.menu-item {
    list-style: none;
    margin-bottom: 4px;
}

.menu-link {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 14px;
    border-radius: 12px;
    color: #444;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.25s ease;
}

.menu-link i {
    font-size: 20px;
    color: #6b6e82;
    transition: 0.25s;
}

/* HOVER */
.menu-link:hover {
    background: #f4f4ff;
    color: #4f46e5;
    transform: translateX(6px);
}

.menu-link:hover i {
    color: #4f46e5;
}

/* ACTIVE */
.menu-item.active .menu-link {
    background: #4f46e5;
    color: #ffffff;
    box-shadow: 0 8px 18px rgba(79,70,229,0.30);
    transform: translateX(0);
}

.menu-item.active .menu-link i {
    color: #ffffff;
}

/* FOOTER */
.sidebar-footer {
    margin-top: 40px;
    text-align: center;
    font-size: 12px;
    color: #4f46e5;
    opacity: 0.6;
}

/* SCROLLBAR */
.sidebar::-webkit-scrollbar { width: 7px; }
.sidebar::-webkit-scrollbar-thumb {
    background: #d6d8f5;
    border-radius: 4px;
}
.sidebar::-webkit-scrollbar-track { background: transparent; }
</style>
