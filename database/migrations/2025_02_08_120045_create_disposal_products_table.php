<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposalProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'quantity_disposed',
        'reason',
        'disposed_at',
    ];

    /**
     * A disposal belongs to a purchase
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
