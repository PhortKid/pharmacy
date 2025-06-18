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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); 
            $table->decimal('unit_price',10,2);
            $table->Integer('quantity_bought');
            $table->String('date_of_purchase');
            $table->decimal('selling_price',10,2);
            $table->decimal('total_purchase',10,2);
            $table->String('payment_method');
            $table->String('expire_date');
            $table->String('manufacturer');
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
