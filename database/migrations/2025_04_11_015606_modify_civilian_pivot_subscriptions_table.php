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
        Schema::table('civilian_pivot_subscriptions', function (Blueprint $table) {
            // Hapus total_paid jika sudah ada
            $table->dropColumn('total_paid');
            
            // Tambahkan kolom baru
            $table->decimal('debit', 12, 2)->default(0)->comment('Total pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
