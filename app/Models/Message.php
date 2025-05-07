<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
    ];

    // Relation vers l'expéditeur (utilisateur)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relation vers le destinataire (utilisateur)
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
