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
            if (Schema::hasColumn('civilian_pivot_subscriptions', 'temp_amount')) {
                $table->dropColumn('temp_amount');
            }
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
