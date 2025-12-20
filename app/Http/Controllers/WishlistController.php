<?php
// app/Http/Controllers/WishlistController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Menampilkan halaman daftar wishlist user.
     */
    public function index()
    {
        // Ambil produk yang di-wishlist oleh user yang sedang login
        $products = auth()->user()->wishlists()
            ->with(['category', 'primaryImage']) // Eager load
            ->latest('wishlists.created_at') // Urutkan dari yang baru di-wishlist
            ->paginate(12);

        return view('wishlist.index', compact('products'));
    }

    /**
     * Toggle wishlist (AJAX handler).
     * Endpoint ini akan dipanggil oleh JavaScript.
     *
     * Konsep Toggle:
     * - Jika user SUDAH like -> Hapus (Unlike/Detach)
     * - Jika user BELUM like -> Tambah (Like/Attach)
     */
  public function toggle(Request $request)
{
    $request->validate([
        'product_id' => 'required|integer|exists:products,id'
    ]);

    $productId = $request->product_id;
    $user = Auth::user();

    $exists = $user->wishlists()->where('product_id', $productId)->exists();

    if ($exists) {
        $user->wishlists()->detach($productId);
        $added = false;
        $message = 'Dihapus dari wishlist';
    } else {
        $user->wishlists()->attach($productId);
        $added = true;
        $message = 'Ditambahkan ke wishlist ❤️';
    }

    return response()->json([
        'success' => true,
        'added' => $added,
        'message' => $message
    ]);
}
}