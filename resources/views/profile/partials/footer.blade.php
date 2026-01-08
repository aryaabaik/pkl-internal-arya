{{-- ================================================
     FILE: resources/views/partials/footer.blade.php
     FUNGSI: Footer Website Premium (Level Dewa)
     ================================================ --}}
<style>
:root {
    --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
    --dark-bg: #0f172a;
    --glass-bg: rgba(255, 255, 255, 0.03);
    --text-muted: #94a3b8;
}

.premium-footer {
    background: var(--dark-bg);
    position: relative;
    padding: 100px 0 40px;
    color: white;
    overflow: hidden;
    font-family: 'Inter', sans-serif;
}

/* Background Decoration */
.premium-footer::before {
    content: '';
    position: absolute;
    top: -150px;
    right: -100px;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
    z-index: 0;
}

.footer-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--text-muted), transparent);
    opacity: 0.2;
}

/* Brand Style */
.footer-logo {
    font-size: 2rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 1.5rem;
    letter-spacing: -1px;
}

.footer-logo span {
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.icon-box {
    background: var(--primary-gradient);
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    font-size: 1.2rem;
    color: white !important;
    -webkit-text-fill-color: white !important;
}

.brand-tagline {
    color: var(--text-muted);
    line-height: 1.8;
    max-width: 320px;
}

/* Social Media Cards */
.social-grid {
    display: flex;
    gap: 12px;
    margin-top: 2rem;
}

.social-card {
    width: 45px;
    height: 45px;
    background: var(--glass-bg);
    border: 1px solid rgba(255,255,255,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    color: white;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.social-card:hover {
    transform: translateY(-5px);
    background: var(--primary-gradient);
    border-color: transparent;
    box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
}

/* Links Style */
.footer-heading {
    text-transform: uppercase;
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 2px;
    margin-bottom: 2rem;
    color: white;
}

.footer-links {
    padding: 0;
    list-style: none;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: var(--text-muted);
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
}

.footer-links a:hover {
    color: #a855f7;
    transform: translateX(8px);
}

/* Newsletter Box */
.newsletter-box {
    display: flex;
    background: var(--glass-bg);
    border: 1px solid rgba(255,255,255,0.1);
    padding: 8px;
    border-radius: 12px;
}

.newsletter-box input {
    background: transparent;
    border: none;
    padding: 10px 15px;
    color: white;
    width: 100%;
    outline: none;
}

.newsletter-box button {
    background: var(--primary-gradient);
    border: none;
    width: 45px;
    height: 40px;
    border-radius: 8px;
    color: white;
    transition: 0.3s;
}

.newsletter-box button:hover {
    opacity: 0.9;
    transform: scale(0.95);
}

/* Contact Info */
.info-item {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
    color: var(--text-muted);
}

.info-item i {
    color: #6366f1;
}

/* Footer Bottom */
.footer-bottom {
    margin-top: 80px;
    padding-top: 30px;
    border-top: 1px solid rgba(255,255,255,0.05);
}

.copyright {
    color: var(--text-muted);
    font-size: 0.9rem;
}

.badge-glass {
    background: var(--glass-bg);
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 700;
    margin-left: 8px;
    border: 1px solid rgba(255,255,255,0.05);
    letter-spacing: 1px;
}

/* Responsive optimization */
@media (max-width: 991.98px) {
    .premium-footer {
        padding: 60px 0 30px;
    }
    .footer-heading {
        margin-bottom: 1rem;
        margin-top: 1rem;
    }
    .brand-section {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .brand-tagline {
        max-width: 100%;
    }
    .social-grid {
        justify-content: center;
    }
    .footer-links a:hover {
        transform: none;
    }
}
</style>
<footer class="premium-footer">
    <div class="footer-overlay"></div>
    <div class="container">
        <div class="row g-5">
            {{-- Brand & Experience --}}
            <div class="col-lg-4">
                <div class="brand-section">
                    <h2 class="footer-logo">
                        <span class="icon-box"><i class="bi bi-bag-heart-fill"></i></span>
                        Toko<span>Online</span>
                    </h2>
                    <p class="brand-tagline">
                        Mendefinisikan ulang pengalaman belanja digital Anda. Kualitas kurasi terbaik dengan keamanan tingkat militer.
                    </p>
                    <div class="social-grid">
                        <a href="#" class="social-card facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/kaceinspace" class="social-card instagram"><i class="bi bi-instagram"></i></a>
                        <a href="https://github.com/kaceinspace" class="social-card github"><i class="bi bi-github"></i></a>
                        <a href="https://www.youtube.com/watch?v=zF6RPKAqX44" class="social-card youtube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>

            {{-- Links Group --}}
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-6">
                        <h6 class="footer-heading">Navigasi</h6>
                        <ul class="footer-links">
                            <li><a href="{{ route('catalog.index') }}">Katalog Eksklusif</a></li>
                            <li><a href="#">Kisah Kami</a></li>
                            <li><a href="#">Karir</a></li>
                            <li><a href="#">Kontak Kami</a></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <h6 class="footer-heading">Dukungan</h6>
                        <ul class="footer-links">
                            <li><a href="#">Pusat Bantuan</a></li>
                            <li><a href="#">Cara Belanja</a></li>
                            <li><a href="#">Lacak Pesanan</a></li>
                            <li><a href="#">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Newsletter / Contact --}}
            <div class="col-lg-4">
                <div class="contact-card">
                    <h6 class="footer-heading">Berlangganan Promo</h6>
                    <div class="newsletter-box">
                        <input type="email" placeholder="Email Anda...">
                        <button><i class="bi bi-arrow-right"></i></button>
                    </div>
                    <div class="contact-info-list mt-4">
                        <div class="info-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>Silicon Valley, Bandung Tech City</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-telephone-outbound-fill"></i>
                            <span>+62 812 3456 7890</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6 order-2 order-md-1">
                    <p class="copyright">
                        &copy; {{ date('Y') }} <strong>TokoOnline</strong>. Crafted with ❤️ for a better web.
                    </p>
                </div>
                <div class="col-md-6 order-1 order-md-2 text-md-end mb-3 mb-md-0">
                    <div class="payment-badges">
                        <span class="badge-glass">VISA</span>
                        <span class="badge-glass">MASTERCARD</span>
                        <span class="badge-glass">GOPAY</span>
                        <span class="badge-glass">OVO</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>