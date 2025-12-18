<?php
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/sapa/{nama?}', function ($nama = 'Semua') {
    return "Halo, $nama! Selamat datang di Toko Online.";

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ================================================
// GOOGLE OAUTH ROUTES
// ================================================
// Route ini diakses oleh browser, tidak perlu middleware auth
// ================================================

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

// routes/web.php

// routes/web.php

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfilController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfilController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfilController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/avatar', [ProfilController::class, 'deleteAvatar'])->name('profile.avatar.destroy');
});