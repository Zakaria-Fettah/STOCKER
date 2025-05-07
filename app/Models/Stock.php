<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Stock extends Model
{
    use HasFactory, HasRoles;

    // Specify the table name if it doesn't follow Laravel's naming convention (optional)
    protected $table = 'stocks';

    // Define fillable fields for mass assignment
    protected $fillable = [
        'idProduit',
        'idCategorie',
        'quantite',
        'description', // Ajout du champ description
    ];

    // Define relationship with Produit model
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idProduit');
    }

    // Define relationship with Categorie model
    public function categorie()
    {
        return $this->belongsTo(Category::class, 'idCategorie');
    }
}