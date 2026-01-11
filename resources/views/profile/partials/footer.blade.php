{{-- ================================================
     FILE: resources/views/partials/footer.blade.php
     FUNGSI: Footer Website (Premium • Clean • Industry Ready)
     ================================================ --}}
<style>
:root {
    --footer-bg: #0b1220;
    --footer-glass: rgba(255,255,255,0.04);
    --footer-border: rgba(255,255,255,0.08);
    --footer-text: #e5e7eb;
    --footer-muted: #94a3b8;
    --footer-accent: #7c3aed;
    --footer-accent-soft: rgba(124,58,237,.15);
}

/* ================= BASE ================= */
.premium-footer {
    background: radial-gradient(
        circle at top right,
        rgba(124,58,237,.12),
        transparent 60%
    ), var(--footer-bg);
    padding: 90px 0 40px;
    color: var(--footer-text);
    position: relative;
    overflow: hidden;
    font-family: 'Inter', sans-serif;
}

.footer-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--footer-border), transparent);
    opacity: .6;
}

/* ================= BRAND ================= */
.footer-logo {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1.8rem;
    font-weight: 900;
    letter-spacing: -0.5px;
    margin-bottom: 1.25rem;
}

.footer-logo span span {
    color: var(--footer-accent);
}

.icon-box {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: var(--footer-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    color: #fff;
}

.brand-tagline {
    color: var(--footer-muted);
    line-height: 1.7;
    max-width: 340px;
}

/* ================= SOCIAL ================= */
.social-grid {
    display: flex;
    gap: 12px;
    margin-top: 1.8rem;
}

.social-card {
    width: 42px;
    height: 42px;
    background: var(--footer-glass);
    border: 1px solid var(--footer-border);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    color: var(--footer-text);
    text-decoration: none;
    transition: all .25s ease;
}

.social-card:hover {
    background: var(--footer-accent);
    border-color: transparent;
    transform: translateY(-3px);
}

/* ================= LINKS ================= */
.footer-heading {
    font-size: .8rem;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 1.6rem;
    color: #fff;
}

.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: var(--footer-muted);
    text-decoration: none;
    font-size: .95rem;
    transition: color .2s ease, padding .2s ease;
}

.footer-links a:hover {
    color: #fff;
    padding-left: 6px;
}

/* ================= NEWSLETTER ================= */
.newsletter-box {
    display: flex;
    gap: 6px;
    background: var(--footer-glass);
    border: 1px solid var(--footer-border);
    padding: 6px;
    border-radius: 14px;
}

.newsletter-box input {
    background: transparent;
    border: none;
    padding: 10px 14px;
    color: #fff;
    width: 100%;
    outline: none;
    font-size: .9rem;
}

.newsletter-box button {
    background: var(--footer-accent);
    border: none;
    width: 44px;
    border-radius: 10px;
    color: white;
    transition: transform .2s ease, opacity .2s ease;
}

.newsletter-box button:hover {
    opacity: .9;
    transform: scale(.95);
}

/* ================= CONTACT ================= */
.info-item {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 14px;
    color: var(--footer-muted);
    font-size: .9rem;
}

.info-item i {
    color: var(--footer-accent);
}

/* ================= BOTTOM ================= */
.footer-bottom {
    margin-top: 70px;
    padding-top: 28px;
    border-top: 1px solid var(--footer-border);
}

.copyright {
    color: var(--footer-muted);
    font-size: .85rem;
}

.badge-glass {
    background: var(--footer-glass);
    padding: 6px 14px;
    border-radius: 20px;
    font-size: .7rem;
    font-weight: 700;
    margin-left: 8px;
    border: 1px solid var(--footer-border);
    letter-spacing: 1px;
    color: var(--footer-text);
}

/* ================= RESPONSIVE ================= */
@media (max-width: 991.98px) {
    .premium-footer {
        padding: 60px 0 30px;
        text-align: center;
    }

    .brand-tagline {
        max-width: 100%;
    }

    .social-grid {
        justify-content: center;
    }

    .footer-links a:hover {
        padding-left: 0;
    }
}
</style>

<footer class="premium-footer">
    <div class="footer-overlay"></div>
    <div class="container">
        <div class="row g-5">

            {{-- BRAND --}}
            <div class="col-lg-4">
                <div class="brand-section">
                    <h2 class="footer-logo">
                        <span class="icon-box"><i class="bi bi-bag-heart-fill"></i></span>
                        Toko<span>Online</span>
                    </h2>
                    <p class="brand-tagline">
                        Platform belanja perlengkapan pilihan dengan sistem aman, cepat, dan terpercaya.
                    </p>
                    <div class="social-grid">
                        <a href="#" class="social-card"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/kaceinspace" class="social-card"><i class="bi bi-instagram"></i></a>
                        <a href="https://github.com/kaceinspace" class="social-card"><i class="bi bi-github"></i></a>
                        <a href="#" class="social-card"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>

            {{-- LINKS --}}
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-6">
                        <h6 class="footer-heading">Navigasi</h6>
                        <ul class="footer-links">
                            <li><a href="{{ route('catalog.index') }}">Katalog</a></li>
                            <li><a href="#">Tentang Kami</a></li>
                            <li><a href="#">Kontak</a></li>
                            <li><a href="#">Karir</a></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <h6 class="footer-heading">Bantuan</h6>
                        <ul class="footer-links">
                            <li><a href="#">Pusat Bantuan</a></li>
                            <li><a href="#">Cara Belanja</a></li>
                            <li><a href="#">Lacak Pesanan</a></li>
                            <li><a href="#">Privasi</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- NEWSLETTER --}}
            <div class="col-lg-4">
                <h6 class="footer-heading">Langganan Info</h6>

                <div class="contact-info-list mt-4">
                    <div class="info-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Bandung, Indonesia</span>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-telephone-outbound-fill"></i>
                        <span>+62 812 3456 7890</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6 order-2 order-md-1">
                    <p class="copyright">
                        © {{ date('Y') }} <strong>TokoOnline</strong>. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 order-1 order-md-2 text-md-end mb-3 mb-md-0">
                    <span class="badge-glass">VISA</span>
                    <span class="badge-glass">MASTERCARD</span>
                    <span class="badge-glass">GOPAY</span>
                    <span class="badge-glass">OVO</span>
                </div>
            </div>
        </div>
    </div>
</footer>
