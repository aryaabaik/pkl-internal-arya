@props(['product'])

<style>
:root {
    --primary: #6366f1;
    --primary-dark: #4338ca;
    --text-dark: #0f172a;
    --text-muted: #64748b;
    --border-soft: rgba(15,23,42,.08);
    --transition: all .25s ease;
}

/* ================= CARD ================= */
.product-card {
    background: #ffffff !important;
    border: 1px solid var(--border-soft) !important;
    border-radius: 16px !important;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: var(--transition);
    position: relative;
}

.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(15,23,42,.12);
}

/* ================= IMAGE ================= */
.img-wrap {
    position: relative;
    aspect-ratio: 1 / 1;
    background: #f8fafc;
    overflow: hidden;
}

.image-main {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .4s ease;
}

.product-card:hover .image-main {
    transform: scale(1.06);
}

/* ================= WISHLIST ================= */
.wishlist-btn {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #ffffff;
    border: 1px solid var(--border-soft);
    display: grid;
    place-items: center;
    color: #ef4444;
    cursor: pointer;
    transition: var(--transition);
    z-index: 3;
}

.wishlist-btn:hover {
    background: #fee2e2;
    transform: scale(1.1);
}

/* ================= BODY ================= */
.card-body {
    padding: 14px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex-grow: 1;
    position: relative;
    z-index: 1;
}

/* LINK FIX (INI KUNCI CLICK) */
.card-body a {
    position: relative;
    z-index: 2;
}

.category {
    font-size: .7rem;
    font-weight: 700;
    color: var(--primary);
    text-transform: uppercase;
    letter-spacing: .04em;
}

.product-title {
    font-size: .95rem;
    font-weight: 700;
    color: var(--text-dark);
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin: 4px 0;
}

/* ================= FOOTER ================= */
.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.price {
    font-weight: 800;
    font-size: 1rem;
    color: var(--primary-dark);
}

.rating {
    background: #fef3c7;
    color: #b45309;
    font-size: .75rem;
    font-weight: 700;
    padding: 4px 8px;
    border-radius: 999px;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 576px) {
    .product-title { font-size: .85rem; }
    .price { font-size: .9rem; }
}
</style>

<div class="product-card">
    {{-- IMAGE --}}
    <div class="img-wrap">
        <img
            src="{{ $product->image_url }}"
            alt="{{ $product->name }}"
            class="image-main"
        >

    </div>

    {{-- BODY --}}
    <div class="card-body">
        <span class="category">{{ $product->category->name }}</span>

        <a href="{{ route('catalog.show', $product->slug) }}" class="text-decoration-none">
            <h6 class="product-title">{{ $product->name }}</h6>
        </a>

        <div class="card-footer">
            <div class="price">{{ $product->formatted_price }}</div>
            <div class="rating">
                <i class="bi bi-star-fill"></i> {{ $product->rating ?? '4.7' }}
            </div>
        </div>
    </div>
</div>
