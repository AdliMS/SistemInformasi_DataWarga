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
        Schema::create('civilian_pivot_subscriptions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('subscription_id');
            $table->foreign('subscription_id')->nullable()->references('id')->on('subscriptions')->onDelete('cascade');

            $table->unsignedBigInteger('civilian_id');
            $table->foreign('civilian_id')->nullable()->references('id')->on('civilians')->onDelete('cascade');

            $table->string('paid_months')->nullable();
            $table->decimal('debit', 2, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('civilian_pivot_subscriptions');
    }
};
