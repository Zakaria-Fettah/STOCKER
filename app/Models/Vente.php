<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Vente extends Model
{
    use HasFactory,hasroles;

    protected $fillable = ['idProduit', 'idClient', 'prix_achat', 'nom', 'idStock', 'quantiteVendue', 'prixUnitaire', 'total', 'benifice'];

    // Relation avec Produit
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idProduit');
    }

    // Relation avec Client
    public function client()
    {
        return $this->belongsTo(Client::class, 'idClient');
    }

    // Relation avec Stock
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'idStock');
    }
}
