<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = ['dateCommande', 'statut'];

    // Ajoute les relations si nécessaire
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
