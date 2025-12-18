<nav id="layout-navbar"
     class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme">

    <!-- Mobile Toggle -->
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="#">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <!-- Search -->
        <div class="navbar-nav align-items-center me-4">
            <div class="nav-item search-wrapper">
                <i class="bx bx-search"></i>
                <input type="text" class="form-control" placeholder="Search...">
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- Star Github -->
            <li class="nav-item me-3 d-none d-xl-block">
                <a class="github-button"
                   href="https://github.com/themeselection/sneat-html-admin-template-free"
                   data-icon="octicon-star"
                   data-size="large"
                   data-show-count="true">
                    Star
                </a>
            </li>

            <!-- User Dropdown -->
            <li class="nav-item dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="#" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('assets/img/avatars/7.png') }}" alt="avatar"
                             class="w-px-40 rounded-circle">
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end quantum-dropdown">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-online me-3">
                                    <img src="{{ asset('assets/img/avatars/7.png') }}" alt="avatar"
                                         class="w-px-40 rounded-circle">
                                </div>
                                <div>
                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li><div class="dropdown-divider"></div></li>

                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bx bx-user me-2"></i> My Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bx bx-cog me-2"></i> Settings</a></li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-credit-card me-2"></i> Billing
                            <span class="badge bg-danger ms-2">4</span>
                        </a>
                    </li>

                    <li><div class="dropdown-divider"></div></li>

                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2"></i> Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
<style>
    /* =============================================================
       ULTRA QUANTUM NAVBAR — LEVEL 9000++ (Dengan Dropdown SOLID)
       ============================================================= */

    #layout-navbar {
        height: 78px;
        border-radius: 26px;
        margin-top: 18px;
        padding: 14px 32px;
        background: rgba(255, 255, 255, 0.32) !important;
        backdrop-filter: blur(28px) saturate(280%) brightness(1.25) !important;
        border: 1px solid rgba(255, 255, 255, 0.45) !important;
        box-shadow: 0 12px 45px rgba(0,0,0,0.22), 0 0 25px rgba(99,102,241,0.25),
                    inset 0 0 25px rgba(255,255,255,0.28);
        transition: 0.35s ease;
        animation: navbarFloat 4s ease-in-out infinite alternate;
    }

    @keyframes navbarFloat {
        0%   { transform: translateY(0px); }
        100% { transform: translateY(-2.5px); }
    }

    #layout-navbar:hover {
        box-shadow: 0 18px 55px rgba(0,0,0,0.26), 0 0 40px rgba(99,102,241,0.35),
                    inset 0 0 30px rgba(255,255,255,0.38);
        transform: translateY(-3px) scale(1.01);
    }

    /* Search tetap sama */
    .search-wrapper input {
        height: 48px;
        padding: 12px 14px 12px 46px;
        background: rgba(255,255,255,0.75);
        border-radius: 16px;
        border: none;
        transition: 0.35s ease;
        font-weight: 500;
    }
    .search-wrapper i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 22px;
        color: #6b7280;
        opacity: .75;
    }

    /* Tombol Tambah Data */
    .btn-primary {
        background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
        border: none;
        font-weight: 600;
        transition: all .3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(99,102,241,0.4) !important;
    }

    /* =============================================================
       DROPDOWN USER — SEKARANG 100% SOLID & TIDAK TRANSPARAN
       ============================================================= */
    .quantum-dropdown {
        background: #ffffff !important;           /* Putih solid */
        border: 1px solid #e5e7eb !important;     /* Border tipis abu-abu */
        border-radius: 20px !important;
        box-shadow:
            0 20px 40px rgba(0,0,0,0.12),
            0 0 30px rgba(99,102,241,0.15) !important;
        padding: 12px 8px !important;
        min-width: 280px;
        margin-top: 12px !important;
        overflow: hidden;
        animation: dropdownSolid .35s ease;
    }

    @keyframes dropdownSolid {
        from { opacity: 0; transform: translateY(-12px) scale(0.95); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .quantum-dropdown .dropdown-item {
        border-radius: 14px !important;
        margin: 4px 8px;
        padding: 12px 16px !important;
        font-weight: 500;
        transition: all .25s ease;
    }

    .quantum-dropdown .dropdown-item:hover {
        background: #6366f1 !important;
        color: white !important;
        transform: translateX(6px);
    }

    .quantum-dropdown .dropdown-item i {
        font-size: 20px;
        width: 26px;
    }

    .quantum-dropdown .badge.bg-danger {
        background: linear-gradient(135deg, #ef4444, #b91c1c) !important;
        font-weight: 700;
    }

    /* Avatar glow tetap */
    .avatar-online img {
        border: 2px solid #6366f1;
        padding: 2px;
        box-shadow: 0 0 15px rgba(99,102,241,0.5);
        transition: .3s ease;
    }
    .avatar-online img:hover {
        transform: scale(1.15);
        box-shadow: 0 0 30px rgba(99,102,241,0.7);
    }

    /* Mobile */
    @media (max-width: 576px) {
        #layout-navbar { padding: 10px 16px; border-radius: 16px; }
        .quantum-dropdown { min-width: 260px; }
    }
</style>
