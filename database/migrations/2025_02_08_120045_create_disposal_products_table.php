<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disposal_products', function (Blueprint $table) {
            $table->id();
            
            // Reference to purchases table
            $table->foreignId('purchase_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->integer('quantity_disposed');
            $table->text('reason')->nullable(); // Optional
            $table->timestamp('disposed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disposal_products');
    }
};
