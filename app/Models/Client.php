<?php

// app/Models/Client.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Client extends Model
{
    use HasFactory,hasroles;

    protected $fillable = [
        'idProduit',
        'idCommande',
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'type_client',
    ];

    // Relation avec le modèle Produit
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idProduit');
    }

    // Relation avec le modèle Commande
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'idCommande');
    }
    
}
