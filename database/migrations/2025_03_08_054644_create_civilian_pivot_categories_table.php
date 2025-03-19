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
        Schema::create('civilian_pivot_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('civilian_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('civilian_id')->nullable()
            ->nullable()->references('id')->on('civilians')->onDelete('cascade');
            $table->foreign('category_id')->nullable()
            ->nullable()->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('civilian_pivot_categories');
    }
};
