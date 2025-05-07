<?php

// app/Models/Achat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Achat extends Model
{
    use HasFactory,hasroles;

    protected $fillable = [
        'idProduit', 'idFournisseur', 'prix_achat', 'date_achat', 'quantite_achat'
    ];

    // Relation avec le modèle Produit (un achat appartient à un produit)
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idProduit');
    }

    // Relation avec le modèle Fournisseur (un achat appartient à un fournisseur)
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'idFournisseur');
    }
}
