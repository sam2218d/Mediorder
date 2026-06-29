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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();

    $table->foreignId('category_id')
          ->constrained('categories')
          ->cascadeOnDelete();

    $table->string('name');
    $table->string('slug')->unique();

    $table->text('description')->nullable();

    $table->string('image')->nullable();

    $table->decimal('price',10,2);

    $table->integer('stock')->default(0);

    $table->boolean('requires_prescription')
          ->default(false);

    $table->string('manufacturer')->nullable();

    $table->date('expiry_date')->nullable();

    $table->enum('status',['active','inactive'])
          ->default('active');

    $table->softDeletes();

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
