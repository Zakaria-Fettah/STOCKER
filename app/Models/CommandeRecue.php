<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class CommandeRecue extends Model
{
    use HasFactory,hasroles;

    protected $fillable = [
        'idFournisseur',
        'quantite',
        'prix',
        'idAchat',
        'dateCommande',
        'statut',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'idFournisseur');
    }

    public function achat()
    {
        return $this->belongsTo(Achat::class, 'idAchat');
    }

    // Relation avec FournisseurCommande
    public function fournisseurCommande()
    {
        return $this->belongsTo(FournisseurCommande::class, 'idFournisseurCommande'); // Vérifie la bonne clé étrangère
    }
}
