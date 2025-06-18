<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
   protected $fillable =[
    'product_id',
    'unit_price',
    'quantity_bought',
    'date_of_purchase',
    'selling_price',
    'total_purchase',
    'payment_method',
    'expire_date',
    'manufacturer',
    'supplier_id'
   ];



   public function product() {
      return $this->belongsTo(Product::class);
  }
  
  public function supplier() {
      return $this->belongsTo(Supplier::class);
  }
  

}
