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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expense_name');
            $table->decimal('amount', 12, 2)->default(0);
            // $table->text('description')->nullable();
            $table->date('expense_date');
            $table->boolean('is_income')->default(false)->after('amount');

            $table->unsignedBigInteger('subscription_id');
            $table->foreign('subscription_id')->nullable()
            ->nullable()->references('id')->on('subscriptions')->onDelete('cascade');

            $table->unsignedBigInteger('civilian_pivot_subscription_id')->nullable()->after('subscription_id');
            $table->foreign('civilian_pivot_subscription_id')->references('id')->on('civilian_pivot_subscriptions');

            $table->timestamps();
        });

        // Data existing dianggap sebagai pengeluaran
        DB::statement("UPDATE expenses SET is_income = false WHERE is_income IS NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropForeign(['civilian_pivot_subscription_id']);
            $table->dropColumn('civilian_pivot_subscription_id');
        });
    }
};
