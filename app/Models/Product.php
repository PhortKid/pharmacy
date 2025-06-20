<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id', 
        'min_stock_level',
    ];

    /**
     * Relationship with Pharmacy
     */
  

    /**
     * Relationship with Category
     * A product belongs to one category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sales()
    {
        return $this->hasMany(Sales::class);
    }

    
    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }

    

}
