<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Produit extends Model
{
    use HasFactory, HasRoles;

    // Assure-toi que le nom du champ ici est correct
    protected $fillable = ['idcategories', 'nom', 'description', 'prix', 'quantite'];

    protected $casts = [
        'prix' => 'decimal:2',
        'quantite' => 'integer',
    ];

    /**
     * Relation vers la catégorie (clé étrangère : idcategories)
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'idcategories');
    }
    public function fournisseurs()
{
    return $this->belongsToMany(Fournisseur::class, 'fournisseur_produit', 'produit_id', 'fournisseur_id');
}

}
