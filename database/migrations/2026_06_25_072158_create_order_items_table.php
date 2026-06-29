<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            
            // This links the item to a specific order! 
            // 'cascade' means if you delete the order, its items get deleted too.
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            
            $table->string('item_name');
            $table->string('item_image')->nullable();
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            
            $table->timestamps();
        });
    }
};
