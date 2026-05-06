<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class emergencyRequest extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'type',
        'description',
        'location',
        'whatsapp',
        'user_id',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
