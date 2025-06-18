<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // Fillable properties
    protected $fillable = [
        'product_id',
        'movement_type',
        'quantity',
        'price_at_time',
        'notes',
       
    ];

    /**
     * Relationship with Product
     * A stock movement belongs to one product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
