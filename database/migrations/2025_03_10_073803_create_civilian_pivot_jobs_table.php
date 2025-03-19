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
        Schema::create('civilian_pivot_jobs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('civilian_id');
            $table->foreign('civilian_id')->nullable()
            ->nullable()->references('id')->on('civilians')->onDelete('cascade');
            
            $table->unsignedBigInteger('civilian_job_id');
            $table->foreign('civilian_job_id')->nullable()
            ->nullable()->references('id')->on('civilian_jobs')->onDelete('cascade');

            $table->string('accepted_date');
            $table->string('retirement_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('civilian_pivot_jobs');
    }
};
