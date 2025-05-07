<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class FournisseurCommande extends Model
{
    use HasFactory,hasroles;

    protected $table = 'fournisseur_commandes';

    protected $fillable = [
        'idCommande',
        'idFournisseur',
    ];

    /**
     * Relation avec le modèle CommandeRecue
     */
    public function commandeRecue()
    {
        return $this->belongsTo(CommandeRecue::class, 'idCommande');
    }

    /**
     * Relation avec le modèle Fournisseur
     */
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'idFournisseur');
    }
}
