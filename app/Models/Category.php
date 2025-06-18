<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unit'
    ];

    /**
     * Relationship with Product
     * A category can have many products.
     */
    public function products()
{
    return $this->hasMany(Product::class);
}


  

}
