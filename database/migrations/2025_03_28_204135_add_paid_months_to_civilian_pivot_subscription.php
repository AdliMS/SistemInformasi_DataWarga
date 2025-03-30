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
            $table->json('paid_months')->nullable()->after('temp_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('civilian_pivot_subscriptions', function (Blueprint $table) {
            //
        });
    }
};
