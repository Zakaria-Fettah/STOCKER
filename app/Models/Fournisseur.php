<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Fournisseur extends Model
{
    use HasFactory,hasroles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * 
     */
    protected $fillable = [
        'idProduit',
        'nom',
        'prenom',
        'adresse',
        'email',
        'telephone',
        'genre',
        'condition_payement',
        'date_livraison',
        'fiabilite',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_livraison' => 'date',
        'genre' => 'string',
    ];

    /**
     * Get the product that this supplier is associated with.
     */
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'fournisseur_produit', 'fournisseur_id', 'produit_id');
    }
    
}