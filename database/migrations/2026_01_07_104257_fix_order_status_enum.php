<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    Schema::table('orders', function (Blueprint $table) {
        // Mengubah kolom enum agar menerima nilai 'completed'
        $table->enum('status', [
            'pending', 
            'confirmed', 
            'processing', 
            'shipped', 
            'completed', 
            'cancelled'
        ])->default('pending')->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Mengembalikan kolom enum ke kondisi semula tanpa 'completed'
            $table->enum('status', [
                'pending', 
                'confirmed', 
                'processing', 
                'shipped', 
                'cancelled'
            ])->default('pending')->change();
        });
    }
};
