<style>
:root {
  --zeus-primary: #6d28d9;       /* lebih dewasa */
  --zeus-accent: #22d3ee;        /* lebih soft */
  --zeus-dark: #0f172a;
  --zeus-glass: rgba(255,255,255,0.88);
  --zeus-border: rgba(15,23,42,.08);
}

/* ================= NAVBAR BASE ================= */
.zeus-navbar {
  position: sticky;
  top: 0;
  z-index: 999;
  backdrop-filter: blur(20px);
  background: var(--zeus-glass);
  border-bottom: 1px solid var(--zeus-border);
  transition: all .35s ease;
}

.zeus-navbar.shrink {
  box-shadow: 0 12px 28px rgba(15,23,42,.12);
}

/* ================= CONTAINER ================= */
.zeus-container {
  max-width: 1280px;
  margin: auto;
  padding: 16px 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

/* ================= BRAND ================= */
.zeus-brand {
  display: flex;
  align-items: center;
  gap: 12px;
  text-decoration: none;
}

.zeus-brand img {
  width: 44px;
  height: 44px;
  border-radius: 14px;
  box-shadow: 0 8px 18px rgba(109,40,217,.25);
}

.zeus-brand span {
  font-size: 1.35rem;
  font-weight: 900;
  color: var(--zeus-dark);
}

.zeus-brand span span {
  color: var(--zeus-primary);
}

/* ================= MENU ================= */
.zeus-menu {
  display: flex;
  gap: 32px;
  list-style: none;
}

.zeus-menu a {
  position: relative;
  text-decoration: none;
  font-weight: 700;
  color: #475569;
  padding: 6px 0;
  transition: color .25s ease;
}

.zeus-menu a::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: -6px;
  width: 0;
  height: 3px;
  background: linear-gradient(90deg,var(--zeus-primary),var(--zeus-accent));
  border-radius: 99px;
  transition: width .3s ease;
}

.zeus-menu a:hover,
.zeus-menu a.active {
  color: var(--zeus-primary);
}

.zeus-menu a:hover::after,
.zeus-menu a.active::after {
  width: 100%;
}

/* ================= ACTIONS ================= */
.zeus-actions {
  display: flex;
  align-items: center;
  gap: 16px;
}

.zeus-icon {
  background: transparent;
  border: none;
  font-size: 1.35rem;
  padding: 10px;
  border-radius: 14px;
  cursor: pointer;
  color: #64748b;
  transition: background .25s ease, color .25s ease, transform .25s ease;
}

.zeus-icon:hover {
  background: rgba(109,40,217,.08);
  color: var(--zeus-primary);
  transform: translateY(-1px);
}

/* ================= PROFILE ================= */
.zeus-profile-trigger {
  display: flex;
  align-items: center;
  gap: 10px;
  text-decoration: none;
  transition: transform .25s ease;
}

.zeus-profile-trigger:hover {
  transform: translateY(-1px);
}

.zeus-profile-trigger img {
  width: 34px;
  height: 34px;
  border-radius: 50%;
}

.user-name {
  font-size: .9rem;
  font-weight: 800;
  color: var(--zeus-dark);
  max-width: 120px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.zeus-profile-trigger i {
  font-size: .75rem;
  opacity: .6;
}

/* ================= DROPDOWN ================= */
.zeus-dropdown {
  margin-top: 12px;
  border-radius: 18px;
  min-width: 260px;
  padding: 0;
  border: none;
  overflow: hidden;
  box-shadow: 0 25px 45px rgba(15,23,42,.18);
}

.zeus-dropdown .dropdown-header {
  background: linear-gradient(135deg,var(--zeus-primary),var(--zeus-accent));
  color: white;
  padding: 16px;
}

.zeus-dropdown .dropdown-header small {
  display: block;
  opacity: .85;
  font-size: .75rem;
}

.zeus-dropdown .dropdown-item {
  padding: 12px 18px;
  font-weight: 600;
  font-size: .9rem;
  transition: background .2s ease, padding .2s ease, color .2s ease;
}

.zeus-dropdown .dropdown-item:hover {
  background: #f5f3ff;
  padding-left: 26px;
  color: var(--zeus-primary);
}
</style>

<nav class="zeus-navbar" id="zeusNavbar">
  <div class="zeus-container">

    <!-- LOGO -->
    <a href="{{ route('home') }}" class="zeus-brand">
      <img src="images/studia.png" alt="Logo">
      <span>Toko<span>Online</span></span>
    </a>

    <!-- MENU -->
    <ul class="zeus-menu">
      <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
      <li><a href="{{ route('catalog.index') }}" class="{{ request()->routeIs('catalog.*') ? 'active' : '' }}">Katalog</a></li>
      <li><a href="{{ route('orders.index') }}" class="{{ request()->routeIs('orders.*') ? 'active' : '' }}">Pesanan Saya</a></li>
    </ul>

    <!-- ACTION -->
    <div class="zeus-actions">
      <a href="{{ route('wishlist.index') }}" class="zeus-icon"><i class="bi bi-heart"></i></a>
      <a href="{{ route('cart.index') }}" class="zeus-icon"><i class="bi bi-bag"></i></a>

      @auth
      <div class="dropdown">
        <a href="#" class="zeus-profile-trigger" data-bs-toggle="dropdown">
          <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=6d28d9&color=fff' }}">
          <span class="user-name">{{ auth()->user()->name }}</span>
          <i class="bi bi-chevron-down"></i>
        </a>

        <ul class="dropdown-menu zeus-dropdown dropdown-menu-end">
          <li class="dropdown-header">
            <strong>{{ auth()->user()->name }}</strong>
            <small>{{ auth()->user()->email }}</small>
          </li>

          <li><hr class="dropdown-divider"></li>

 <li>
          <a class="dropdown-item" href="{{ route('profile.show', auth()->id()) }}">
            <i class="bi bi-person me-2"></i> Akun Saya
          </a>
        </li>          <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i class="bi bi-box me-2"></i> Pesanan Saya</a></li>

          @if(auth()->user()->isAdmin())
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item fw-bold text-primary" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Admin Panel</a></li>
          @endif

          <li><hr class="dropdown-divider"></li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item text-danger">
                <i class="bi bi-box-arrow-right me-2"></i> Keluar
              </button>
            </form>
          </li>
        </ul>
      </div>
      @endauth

      @guest
      <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-3">Masuk</a>
      <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-3">Daftar</a>
      @endguest
    </div>

  </div>
</nav>

<script>
const navbar = document.getElementById('zeusNavbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('shrink', window.scrollY > 40);
});

/* batasi efek mouse biar gak lebay */
document.querySelectorAll('.zeus-icon').forEach(el => {
  el.addEventListener('mouseenter', () => {
    el.style.transform = 'translateY(-1px)';
  });
  el.addEventListener('mouseleave', () => {
    el.style.transform = 'translateY(0)';
  });
});
</script>
