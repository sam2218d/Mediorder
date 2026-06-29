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
    {Schema::create('orders', function (Blueprint $table) {
        $table->id();
        // Contact Info
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email');
        
        // Shipping Address
        $table->string('street_address');
        $table->string('city');
        $table->string('state');
        $table->string('zip_code');
        
        // File Paths
        $table->string('prescription_path');
        $table->string('payment_proof_path');
        
        // Order Status/Totals (Optional but recommended)
        $table->decimal('total_amount', 10, 2)->nullable();
        $table->string('status')->default('pending');
        
        $table->timestamps();

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
