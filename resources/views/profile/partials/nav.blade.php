<style>:root {
  --zeus-primary: #7c3aed;
  --zeus-accent: #00eaff;
  --zeus-dark: #0f172a;
  --zeus-glass: rgba(255,255,255,0.75);
}

/* NAVBAR BASE */
.zeus-navbar {
  position: sticky;
  top: 0;
  z-index: 999;
  backdrop-filter: blur(18px);
  background: var(--zeus-glass);
  border-bottom: 1px solid rgba(255,255,255,.4);
  transition: all .4s ease;
}

.zeus-navbar.shrink {
  padding: 6px 0;
  box-shadow: 0 20px 40px rgba(0,0,0,.12);
}

/* CONTAINER */
.zeus-container {
  max-width: 1280px;
  margin: auto;
  padding: 14px 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

/* BRAND */
.zeus-brand {
  display: flex;
  align-items: center;
  gap: 12px;
  text-decoration: none;
}

.zeus-brand img {
  width: 46px;
  height: 46px;
  border-radius: 14px;
  box-shadow: 0 10px 25px rgba(124,58,237,.35);
}

.zeus-brand span {
  font-size: 1.4rem;
  font-weight: 900;
  color: var(--zeus-dark);
}

.zeus-brand span span {
  color: var(--zeus-primary);
}

/* MENU */
.zeus-menu {
  display: flex;
  gap: 36px;
  list-style: none;
}

.zeus-menu a {
  position: relative;
  text-decoration: none;
  font-weight: 700;
  color: #475569;
  padding: 8px 0;
  transition: .3s;
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
  transition: .4s;
}

.zeus-menu a:hover,
.zeus-menu a.active {
  color: var(--zeus-primary);
}

.zeus-menu a:hover::after,
.zeus-menu a.active::after {
  width: 100%;
}

/* ACTIONS */
.zeus-actions {
  display: flex;
  align-items: center;
  gap: 18px;
}

.zeus-icon {
  background: transparent;
  border: none;
  font-size: 1.4rem;
  padding: 10px;
  border-radius: 14px;
  cursor: pointer;
  color: #64748b;
  transition: .3s;
}

.zeus-icon:hover {
  background: rgba(124,58,237,.1);
  color: var(--zeus-primary);
  transform: translateY(-2px);
}

/* PROFILE */
.zeus-profile {
  display: flex;
  align-items: center;
  gap: 10px;
  background: rgba(255,255,255,.9);
  padding: 6px 14px 6px 6px;
  border-radius: 999px;
  box-shadow: 0 10px 25px rgba(0,0,0,.08);
  cursor: pointer;
  transition: .3s;
}

.zeus-profile:hover {
  transform: translateY(-2px);
}

.zeus-profile img {
  width: 34px;
  height: 34px;
  border-radius: 50%;
}

.zeus-profile span {
  font-size: .9rem;
  font-weight: 800;
  color: var(--zeus-dark);
}

/* PROFILE TRIGGER */
.zeus-profile-trigger {
  display: flex;
  align-items: center;
  gap: 10px;
  background: rgba(255,255,255,.85);
  padding: 6px 14px 6px 6px;
  border-radius: 999px;
  text-decoration: none;
  box-shadow: 0 10px 25px rgba(0,0,0,.08);
  transition: .3s;
}

.zeus-profile-trigger:hover {
  transform: translateY(-2px);
}

.zeus-profile-trigger img {
  width: 34px;
  height: 34px;
  border-radius: 50%;
}

.user-name {
  font-size: .9rem;
  font-weight: 800;
  color: #0f172a;
  max-width: 120px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.zeus-profile-trigger i {
  font-size: .8rem;
  opacity: .6;
}

/* DROPDOWN */
.zeus-dropdown {
  margin-top: 12px;
  border-radius: 18px;
  min-width: 260px;
  padding: 0;
  border: none;
  overflow: hidden;
  box-shadow: 0 25px 50px rgba(0,0,0,.15);
}

.zeus-dropdown .dropdown-header {
  background: linear-gradient(135deg,#7c3aed,#00eaff);
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
  transition: .25s;
}

.zeus-dropdown .dropdown-item:hover {
  background: #f5f3ff;
  padding-left: 26px;
  color: #7c3aed;
}

</style>
<nav class="zeus-navbar" id="zeusNavbar">

  <div class="zeus-container">

    <!-- LOGO -->
    <a href="#" class="zeus-brand">
      <img src="images/8.jpg" alt="Logo">
      <span>Toko<span>Online</span></span>
    </a>

    <!-- MENU -->
    <ul class="zeus-menu">
      <li><a href="#" class="active">Beranda</a></li>
      <li><a href="#">Katalog</a></li>
      <li><a href="#">Terbaru</a></li>
    </ul>

    <!-- ACTION -->
    <div class="zeus-actions">
      <button class="zeus-icon"><i class="bi bi-heart"></i></button>
      <button class="zeus-icon"><i class="bi bi-bag"></i></button>

     <div class="zeus-profile dropdown">
  <a href="#" class="zeus-profile-trigger" data-bs-toggle="dropdown" aria-expanded="false">
    <img
      src="{{ auth()->user()->avatar_url 
        ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=7c3aed&color=fff' }}"
      alt="Avatar">
    <span class="user-name">
      {{ auth()->user()->name }}
    </span>
    <i class="bi bi-chevron-down"></i>
  </a>

  <ul class="dropdown-menu zeus-dropdown dropdown-menu-end">
    <li class="dropdown-header">
      <strong>{{ auth()->user()->name }}</strong>
      <small>{{ auth()->user()->email }}</small>
    </li>

    <li><hr class="dropdown-divider"></li>

    <li>
      <a class="dropdown-item" href="{{ route('profile.edit') }}">
        <i class="bi bi-person me-2"></i> Akun Saya
      </a>
    </li>

    <li>
      <a class="dropdown-item" href="{{ route('orders.index') }}">
        <i class="bi bi-box me-2"></i> Pesanan Saya
      </a>
    </li>

    @if(auth()->user()->isAdmin())
      <li><hr class="dropdown-divider"></li>
      <li>
        <a class="dropdown-item text-primary fw-bold" href="{{ route('admin.dashboard') }}">
          <i class="bi bi-speedometer2 me-2"></i> Admin Panel
        </a>
      </li>
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

    </div>

  </div>
</nav>
<script>
  const navbar = document.getElementById('zeusNavbar');

  window.addEventListener('scroll', () => {
    navbar.classList.toggle('shrink', window.scrollY > 40);
  });

  document.querySelectorAll('.zeus-icon, .zeus-profile').forEach(el => {
    el.addEventListener('mousemove', e => {
      const rect = el.getBoundingClientRect();
      const x = e.clientX - rect.left - rect.width / 2;
      const y = e.clientY - rect.top - rect.height / 2;
      el.style.transform = `translate(${x * 0.05}px, ${y * 0.05}px)`;
    });

    el.addEventListener('mouseleave', () => {
      el.style.transform = 'translate(0,0)';
    });
  });
  document.querySelectorAll('.dropdown').forEach(drop => {
    drop.addEventListener('hide.bs.dropdown', e => {
      drop.querySelector('.zeus-profile-trigger')
          .style.transform = 'translateY(0)';
    });
  });
</script>
