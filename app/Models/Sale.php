<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity_sold',
        'purchase_id',
        'user_id',
        'total_price',
        'receipt_no',
    ];

    /**
     * Sale belongs to a Purchase
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * Sale belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
