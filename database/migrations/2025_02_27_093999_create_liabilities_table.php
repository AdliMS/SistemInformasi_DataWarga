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
        Schema::create('liabilities', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->date('born_date');
            $table->string('gender');
            $table->string('last_education');

            $table->unsignedBigInteger('civilian_id');
            $table->foreign('civilian_id')->nullable()
            ->nullable()->references('id')->on('civilians')->onDelete('cascade');

            $table->unsignedBigInteger('education_id');
            $table->foreign('education_id')->nullable()
            ->nullable()->references('id')->on('educations')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liabilities');
    }
};
