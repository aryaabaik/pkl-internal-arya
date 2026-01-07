@props(['product', 'variant' => null])

<style>
    :root {
        --tkp-primary: #60A5FA;
        --tkp-primary-dark: #1E90FF;
        --tkp-primary-light: #EAF6FF;
        --text-dark: #1a1d23;
        --text-muted: #64748b;
        --transition-smooth: all 0.3s cubic-bezier(.2,.9,.3,1);
    }

    /* ===== MODERN PRODUCT CARD ===== */
    .product-card {
        background: linear-gradient(135deg, #ffffff 0%, #f7fbff 100%);
        border: 1px solid rgba(96, 165, 250, 0.08) !important;
        border-radius: 16px !important;
        overflow: hidden !important;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06) !important;
        transition: var(--transition-smooth);
        height: 100%;
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-12px) scale(1.01);
        box-shadow: 0 20px 48px rgba(96, 165, 250, 0.18) !important;
        border-color: rgba(96, 165, 250, 0.2) !important;
    }

    /* ===== IMAGE WRAPPER ===== */
    .img-wrap {
        position: relative;
        padding-top: 90% !important;
        background: linear-gradient(135deg, #f0f7ff, #e0f2ff);
        overflow: hidden !important;
        border-radius: 14px 14px 0 0 !important;
        group: 'img';
    }

    .img-wrap::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(96, 165, 250, 0.1), transparent);
        z-index: 1;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .product-card:hover .img-wrap::before {
        opacity: 1;
    }

    .image-main {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        transition: var(--transition-smooth);
        will-change: transform;
    }

    .product-card:hover .image-main {
        transform: scale(1.08) rotate(2deg);
    }

    /* ===== GRADIENT OVERLAY ===== */
    .img-gradient-overlay {
        position: absolute !important;
        inset: 0 !important;
        background: linear-gradient(180deg, 
            rgba(0, 0, 0, 0) 0%, 
            rgba(0, 0, 0, 0.12) 100%);
        pointer-events: none !important;
        z-index: 2;
    }

    /* ===== BADGE STYLES ===== */
    .badge-container {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        padding: 12px !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: flex-start !important;
        z-index: 10;
        pointer-events: auto;
    }

    .badge-top-left {
        background: linear-gradient(135deg, #FF6B6B, #FF8787) !important;
        border: none;
        padding: 8px 14px !important;
        border-radius: 12px !important;
        font-weight: 700 !important;
        font-size: 0.85rem !important;
        box-shadow: 0 4px 16px rgba(255, 107, 107, 0.3);
        animation: badgePop 0.4s ease;
        color: #fff !important;
        display: inline-block;
    }

    @keyframes badgePop {
        from {
            transform: scale(0.8) rotate(-20deg);
            opacity: 0;
        }
        to {
            transform: scale(1) rotate(0);
            opacity: 1;
        }
    }

    /* ===== WISHLIST BUTTON ===== */
    .wishlist-btn {
        width: 44px !important;
        height: 44px !important;
        border-radius: 50% !important;
        background: rgba(255, 255, 255, 0.95) !important;
        border: 2px solid rgba(96, 165, 250, 0.2) !important;
        display: grid !important;
        place-items: center !important;
        transition: var(--transition-smooth);
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.12) !important;
        padding: 0 !important;
        color: #e11d48;
        flex-shrink: 0;
    }

    .wishlist-btn:hover {
        background: #fff !important;
        border-color: #e11d48 !important;
        transform: scale(1.15) rotate(12deg);
        box-shadow: 0 10px 28px rgba(225, 29, 72, 0.2) !important;
    }

    .wishlist-btn i {
        font-size: 1.2rem;
        color: #e11d48;
    }

    /* ===== CARD OVERLAY / CTA ===== */
    .card-overlay {
        position: absolute !important;
        left: 50%;
        transform: translateX(-50%) translateY(16px);
        bottom: 16px;
        z-index: 6;
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s cubic-bezier(0.2, 0.9, 0.3, 1);
        width: 88%;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 10px !important;
    }

    .product-card:hover .card-overlay {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
        pointer-events: auto;
    }

    .card-overlay .btn {
        background: linear-gradient(135deg, #667eea, #764ba2) !important;
        border: none !important;
        color: #fff !important;
        font-weight: 700 !important;
        padding: 11px 22px !important;
        border-radius: 12px !important;
        flex: 1;
        transition: var(--transition-smooth);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.2);
        font-size: 0.9rem !important;
    }

    .card-overlay .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(102, 126, 234, 0.3);
        background: linear-gradient(135deg, #764ba2, #667eea) !important;
    }

    .card-overlay .btn-light {
        background: rgba(255, 255, 255, 0.95) !important;
        color: var(--text-dark) !important;
    }

    .card-overlay .btn-light:hover {
        background: #fff !important;
    }

    /* ===== CARD BODY ===== */
    .card-body {
        flex-grow: 1 !important;
        display: flex !important;
        flex-direction: column !important;
        padding: 14px !important;
        gap: 8px;
    }

    /* Category */
    .card-body > small {
        color: var(--tkp-primary-dark);
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ===== PRODUCT TITLE ===== */
    .product-title {
        font-size: 0.95rem !important;
        font-weight: 700 !important;
        color: var(--text-dark) !important;
        line-height: 1.4;
        margin: 6px 0 !important;
        transition: var(--transition-smooth);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-card:hover .product-title {
        color: var(--tkp-primary-dark);
    }

    /* ===== PRICE BLOCK ===== */
    .price-block {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .price-sale {
        font-size: 1.2rem !important;
        font-weight: 800 !important;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .price-base {
        font-size: 1.05rem !important;
        font-weight: 800 !important;
        color: var(--tkp-primary-dark) !important;
    }

    .price-original {
        font-size: 0.8rem !important;
        color: rgba(100, 116, 139, 0.7) !important;
        text-decoration: line-through !important;
    }

    /* ===== RATING BADGE ===== */
    .rating-badge {
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(255, 152, 0, 0.1)) !important;
        color: #FFB300 !important;
        border: 1px solid rgba(255, 193, 7, 0.3) !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 4px 8px !important;
        border-radius: 999px !important;
        display: flex !important;
        align-items: center !important;
        gap: 4px;
        white-space: nowrap;
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.1);
    }

    .rating-badge i {
        color: #FFB300;
    }

    /* ===== FEATURED VARIANT (Purple) ===== */
    .featured-card-wrap .product-card {
        background: linear-gradient(135deg, #667eea 8%, #764ba2 100%) !important;
        border: none !important;
        color: #fff;
        box-shadow: 0 16px 40px rgba(102, 126, 234, 0.2) !important;
    }

    .featured-card-wrap .product-card:hover {
        transform: translateY(-14px) scale(1.01);
        box-shadow: 0 24px 56px rgba(102, 126, 234, 0.3) !important;
    }

    .featured-card-wrap .product-card .card-body > small {
        color: rgba(255, 255, 255, 0.85);
    }

    .featured-card-wrap .product-card .product-title {
        color: #fff !important;
    }

    .featured-card-wrap .product-card .product-title:hover {
        color: rgba(255, 255, 255, 0.95) !important;
    }

    .featured-card-wrap .product-card .price-sale {
        background: linear-gradient(135deg, #FFD700, #FFA500);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .featured-card-wrap .product-card .price-base {
        color: rgba(255, 255, 255, 0.9) !important;
    }

    .featured-card-wrap .product-card .price-original {
        color: rgba(255, 255, 255, 0.6) !important;
    }

    .featured-card-wrap .product-card .rating-badge {
        background: rgba(255, 255, 255, 0.2) !important;
        border-color: rgba(255, 255, 255, 0.4) !important;
        color: #FFD700 !important;
    }

    .featured-card-wrap .product-card .img-wrap {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    }

    /* ===== NEW VARIANT (Gradient Blue) ===== */
    .new-card-wrap .product-card {
        background: linear-gradient(180deg, #ffffff 0%, #f0f7ff 100%) !important;
        border: 1px solid rgba(96, 165, 250, 0.12) !important;
    }

    .new-card-wrap .product-card:hover {
        box-shadow: 0 22px 52px rgba(96, 165, 250, 0.15) !important;
    }

    .new-badge {
        background: linear-gradient(135deg, #1E90FF, #00BFFF) !important;
        color: #fff !important;
        font-weight: 700 !important;
        padding: 8px 14px !important;
        border-radius: 999px !important;
        font-size: 0.75rem !important;
        box-shadow: 0 6px 18px rgba(30, 144, 255, 0.2);
        animation: badgeFloat 2s ease-in-out infinite;
        display: inline-block;
    }

    @keyframes badgeFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }

    /* ===== MODERN CARD VARIANT ===== */
    .modern-card {
        border-radius: 16px !important;
        overflow: hidden !important;
        position: relative;
    }

    .modern-card .image-main {
        transition: transform 0.6s cubic-bezier(0.2, 0.9, 0.3, 1);
        will-change: transform;
    }

    .modern-card:hover .image-main {
        transform: scale(1.1) rotate(-2deg);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 576px) {
        .product-card {
            border-radius: 12px !important;
        }

        .img-wrap {
            border-radius: 10px 10px 0 0 !important;
        }

        .card-body {
            padding: 12px !important;
        }

        .product-title {
            font-size: 0.85rem !important;
        }

        .price-sale,
        .price-base {
            font-size: 1rem !important;
        }

        .card-overlay {
            width: 92%;
        }

        .card-overlay .btn {
            padding: 9px 16px !important;
            font-size: 0.8rem !important;
        }

        .badge-container {
            padding: 10px !important;
        }

        .wishlist-btn {
            width: 40px !important;
            height: 40px !important;
        }
    }

    /* Animation untuk product-card entrance */
    @keyframes cardSlideIn {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .product-card {
        animation: cardSlideIn 0.4s ease forwards;
    }

    .featured-card-wrap:nth-child(1) .product-card { animation-delay: 0.05s; }
    .featured-card-wrap:nth-child(2) .product-card { animation-delay: 0.1s; }
    .featured-card-wrap:nth-child(3) .product-card { animation-delay: 0.15s; }
    .featured-card-wrap:nth-child(4) .product-card { animation-delay: 0.2s; }
    .featured-card-wrap:nth-child(5) .product-card { animation-delay: 0.25s; }
    .featured-card-wrap:nth-child(6) .product-card { animation-delay: 0.3s; }
</style>

<div class="card h-100 border-0 shadow-sm product-card modern-card">
    {{-- IMAGE AREA --}}
    <div class="img-wrap position-relative overflow-hidden bg-light">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
             class="image-main">

        {{-- Badge Container (Discount + Wishlist) --}}
        <div class="badge-container">
            {{-- Discount Badge (kiri) --}}
            @if($product->has_discount)
                <span class="badge badge-top-left">
                    🔥 -{{ $product->discount_percentage }}%
                </span>
            @else
                <div></div>
            @endif

            {{-- Wishlist Button (kanan) --}}
            <button class="btn btn-sm wishlist-btn" 
                    title="Tambah Wishlist"
                    onclick="toggleWishlist(this)">
                <i class="bi bi-heart"></i>
            </button>
        </div>

        {{-- Subtle Gradient Overlay --}}
        <div class="img-gradient-overlay position-absolute w-100 h-100"></div>

        {{-- Overlay CTA (Bottom) --}}
        <div class="card-overlay">
            <a href="{{ route('catalog.show', $product->slug) }}" class="btn btn-sm fw-bold">
                <i class="bi bi-eye"></i> Detail
            </a>
        </div>
    </div>

    {{-- INFO SECTION --}}
    <div class="card-body">
        <small class="text-muted">{{ $product->category->name }}</small>

        <a href="{{ route('catalog.show', $product->slug) }}" class="text-decoration-none stretched-link">
            <h6 class="card-title product-title">{{ \Illuminate\Support\Str::limit($product->name, 60) }}</h6>
        </a>

        {{-- Price & Rating Section --}}
        <div class="d-flex align-items-flex-end justify-content-between mt-auto">
            <div class="price-block">
                @if($product->has_discount)
                    <div class="price-sale">{{ $product->formatted_price }}</div>
                    <div class="price-original">{{ $product->formatted_original_price }}</div>
                @else
                    <div class="price-base">{{ $product->formatted_price }}</div>
                @endif
            </div>

            <span class="badge rating-badge">
                <i class="bi bi-star-fill"></i> 
                {{ $product->rating ?? '4.6' }}
            </span>
        </div>
    </div>
</div>

<script>
    function toggleWishlist(btn) {
        const icon = btn.querySelector('i');
        btn.classList.toggle('active');
        
        if(btn.classList.contains('active')) {
            icon.classList.remove('bi-heart');
            icon.classList.add('bi-heart-fill');
            btn.style.borderColor = '#e11d48';
        } else {
            icon.classList.remove('bi-heart-fill');
            icon.classList.add('bi-heart');
            btn.style.borderColor = 'rgba(96, 165, 250, 0.2)';
        }
    }
</script>