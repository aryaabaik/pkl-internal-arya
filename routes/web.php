<?php
// ================================================
// FILE: routes/web.php
// FUNGSI: Definisi semua route website
// ================================================

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\MidtransNotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ================================================
// HALAMAN PUBLIK (Tanpa Login)
// ================================================
// Halaman Loading



// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(GoogleController::class)->group(function () {
    // ================================================
    // ROUTE 1: REDIRECT KE GOOGLE
    // ================================================
    // URL: /auth/google
    // Dipanggil saat user klik tombol "Login dengan Google"
    // ================================================
    Route::get('/auth/google', 'redirect')
        ->name('auth.google');

    // ================================================
    // ROUTE 2: CALLBACK DARI GOOGLE
    // ================================================
    // URL: /auth/google/callback
    // Dipanggil oleh Google setelah user klik "Allow"
    // URL ini HARUS sama dengan yang didaftarkan di Google Console!
    // ================================================
    Route::get('/auth/google/callback', 'callback')
        ->name('auth.google.callback');
});


// Katalog Produk
Route::get('/products', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/products/{slug}', [CatalogController::class, 'show'])->name('catalog.show');

Route::post('/wishlist/{product}', [WishlistController::class, 'toggle'])
    ->middleware('auth')
    ->name('wishlist.toggle');

    
// ================================================
// HALAMAN YANG BUTUH LOGIN (Customer)
// ================================================

Route::middleware('auth')->group(function () {
    // Keranjang Belanja
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

   // Pesanan Saya
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Profil
    Route::get('/profile', [ProfilController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfilController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfilController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfilController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfilController::class, 'update'])->name('update');
        Route::delete('/', [ProfilController::class, 'destroy'])->name('destroy');
        Route::delete('/avatar', [ProfilController::class, 'deleteAvatar'])->name('avatar.destroy');
        Route::put('/password', [ProfilController::class, 'updatePassword'])->name('password.update');
        Route::get('/{user}', [ProfilController::class, 'show'])->name('show');
    });

// ================================================
// HALAMAN ADMIN (Butuh Login + Role Admin)
// ================================================

// Route produk & kategori untuk user biasa (misalnya halaman depan toko)
Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::resource('categories', CategoryController::class)->only(['index', 'show']);

// ====================
// ROUTE KHUSUS ADMIN (harus login + role admin)
// ====================

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Produk CRUD (khusus admin)
    Route::resource('products', AdminProductController::class);

    // Kategori CRUD (khusus admin)
    Route::resource('categories', AdminCategoryController::class)->except(['show']);

    // Manajemen Pesanan
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    // Laporan 
    Route::get('/reports/sales', [App\Http\Controllers\Admin\ReportController::class, 'sales'])->name('reports.sales');
    Route::get('/reports/sales/export', [App\Http\Controllers\Admin\ReportController::class, 'exportSales'])->name('reports.export-sales');

});

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/product/{slug}', [CatalogController::class, 'show'])->name('catalog.show');
// ================================================
// AUTH ROUTES (dari Laravel UI)
// ================================================
// routes/web.php (HAPUS SETELAH TESTING!)


Route::middleware('auth')->group(function () {

    // ======================
    // ORDER PAYMENT FLOW
    // ======================

    // Halaman bayar (aman pakai {order})
    Route::get('/orders/{order}/pay', [PaymentController::class, 'show'])
        ->name('orders.pay');

    // Generate Snap Token
    Route::post('/payment/snap/{order}', [PaymentController::class, 'snap'])
        ->name('payment.snap');

    // ======================
    // MIDTRANS REDIRECT
    // ======================

    // ❗ JANGAN pakai {order}
    Route::get('/orders/success/{order}', [PaymentController::class, 'success'])
        ->name('orders.success');

    Route::get('/orders/pending/{order}', [PaymentController::class, 'pending'])
        ->name('orders.pending');

        // routes/api.php
Route::post('/midtrans-callback', [PaymentController::class, 'callback']);
});


// routes/web.php
// routes/web.php
Route::post('/midtrans/webhook', [MidtransNotificationController::class, 'handle']);


// ============================================================
// MIDTRANS WEBHOOK
// Route ini HARUS public (tanpa auth middleware)
// Karena diakses oleh SERVER Midtrans, bukan browser user
// ============================================================
Route::post('midtrans/notification', [MidtransNotificationController::class, 'handle'])
    ->name('midtrans.notification');

// Batasi 5 request per menit
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');
Auth::routes();