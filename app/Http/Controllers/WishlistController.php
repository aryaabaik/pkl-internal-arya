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
    $products = auth()->user()
        ->wishlistProducts()
        ->with(['category', 'primaryImage'])
        ->orderByPivot('created_at', 'desc')
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
public function toggle(Product $product)
{
    $user = auth()->user();
    $exists = $user->wishlistProducts()->where('product_id', $product->id)->exists();

    if ($exists) {
        $user->wishlistProducts()->detach($product->id);
        $status = 'removed';
        $message = 'Dihapus dari wishlist';
    } else {
        $user->wishlistProducts()->attach($product->id);
        $status = 'added';
        $message = 'Ditambahkan ke wishlist ❤️';
    }

    // Jika permintaan dari AJAX (JavaScript fetch)
    if (request()->ajax() || request()->wantsJson()) {
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    // Jika klik biasa (fallback)
    return back()->with('success', $message);
}

}