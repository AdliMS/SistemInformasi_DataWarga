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
        Schema::create('civilian_pivot_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('civilian_id');
            $table->unsignedBigInteger('activity_id');
            $table->integer('progress')->default(0);
            $table->timestamps();
            
            $table->foreign('civilian_id')->references('id')->on('civilians')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
            
            // Optional: tambahkan index untuk performa
            $table->index(['civilian_id', 'activity_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
