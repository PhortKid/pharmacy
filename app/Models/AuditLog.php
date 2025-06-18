<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'event', 'table_name', 'old_data', 'new_data', 'ip_address'
    ];

    // Fungua old_data na new_data katika format ya JSON
    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];

    // Fungua mahusiano na User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
