<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Livraison extends Model
{
    use HasFactory,hasroles;

    // Définir les attributs mass-assignable
    protected $fillable = [
        'date', 
        'statut', 
        'quantite', 
        'type', 
        'idClient', 
        'idCommande', 
        'idCategorie', 
        'idProduit'
    ];

    // Définir les relations avec les autres modèles
    public function client()
    {
        return $this->belongsTo(Client::class, 'idClient');
    }

    public function commande()
    {
        return $this->belongsTo(CommandeEnvoyee::class, 'idCommande');
    }

    public function categorie()
    {
        return $this->belongsTo(CategorY::class, 'idCategorie');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idProduit');
    }
}
