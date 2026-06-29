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
        Schema::table('orders', function (Blueprint $table) {
            // Adding the two new columns
            $table->string('item_name')->nullable()->after('zip_code');
            $table->string('item_image')->nullable()->after('item_name');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Dropping them if we ever rollback
            $table->dropColumn(['item_name', 'item_image']);
        });
    }
};
