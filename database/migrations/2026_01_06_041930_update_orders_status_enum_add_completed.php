<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        // Add 'completed' to the existing ENUM values for orders.status
        DB::statement("ALTER TABLE `orders` MODIFY `status` ENUM('pending','processing','shipped','delivered','cancelled','completed') NOT NULL DEFAULT 'pending'");
    }  

    public function down(): void
    {
        // Revert: remove 'completed' (ensure no rows use it before rolling back)
        DB::statement("ALTER TABLE `orders` MODIFY `status` ENUM('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending'");
    }
};
