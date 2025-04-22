<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->unsignedBigInteger('civilian_pivot_subscription_id')->nullable()->after('subscription_id');
            $table->foreign('civilian_pivot_subscription_id')->references('id')->on('civilian_pivot_subscriptions');
        });
    }

    public function down()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropForeign(['civilian_pivot_subscription_id']);
            $table->dropColumn('civilian_pivot_subscription_id');
        });
    }
    };
