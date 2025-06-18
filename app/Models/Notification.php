<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',  // Kichwa cha notification
        'message', // Maelezo ya notification
        'icon', // Aina ya icon (mfano: 'bi bi-bell')
        'color', // Rangi ya notification (mfano: 'primary', 'danger', 'success')
        'is_read', // Ikiwa notification imeonekana au la (1 = read, 0 = unread)
        'user_id', // Mhusika anayepokea notification
    ];

    // Fungua created_at katika lugha ya kawaida
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->diffForHumans();
    }

    // Mahusiano (Notification inahusiana na User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
