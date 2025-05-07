<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class CommandeEnvoyee extends Model
{
    use HasFactory,hasroles;

    // Nom de la table (optionnel si le nom est bien au pluriel)
    protected $table = 'commandes_envoyees';

    // Attributs pouvant être assignés en masse
    protected $fillable = [
        'dateCommande',
        'statut',
        'client_id', // Ajouté ici pour permettre l'enregistrement via create()
    ];

    // Attributs protégés (ici vide car tout est dans $fillable)
    protected $guarded = [];

    // Format des dates
    protected $dates = ['dateCommande'];

    // Activation des timestamps created_at / updated_at
    public $timestamps = true;

    // Relation : une commande envoyée appartient à un client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
