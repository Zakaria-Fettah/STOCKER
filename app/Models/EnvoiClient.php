<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvoiClient extends Model
{
    use HasFactory;
    protected $table = 'envoi_clients';
    protected $fillable = ['idClient', 'idCommandeEnvoyee', 'idCommandeReçue'];

    // Relation avec la commande envoyée
    public function commandeEnvoyee()
    {
        return $this->belongsTo(Commande::class, 'idCommandeEnvoyee');
    }

    // Relation avec la commande reçue
    public function commandeRecue()
    {
        return $this->belongsTo(Commande::class, 'idCommandeReçue');
    }

    // Relation avec le client
    public function client()
    {
        return $this->belongsTo(Client::class, 'idClient');
    }
}
