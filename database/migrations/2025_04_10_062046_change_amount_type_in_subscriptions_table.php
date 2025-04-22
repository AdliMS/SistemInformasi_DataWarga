<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // Tambahkan kolom temporary
            $table->decimal('amount_temp', 12, 2)->default(0);
        });
        
        // Update data ke kolom temporary
        DB::statement('UPDATE subscriptions SET amount_temp = CAST(amount AS DECIMAL(12,2))');
        
        Schema::table('subscriptions', function (Blueprint $table) {
            // Hapus kolom lama
            $table->dropColumn('amount');
            // Rename kolom temporary
            $table->renameColumn('amount_temp', 'amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            //
        });
    }
};
