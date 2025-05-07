<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueStock extends Model
{
    use HasFactory;

    protected $table = 'historique_stocks';

    protected $fillable = [
        'idClient',
        'idFournisseur',
        'idProduit',
        'idCategorie',
        'idCommande',
        'idLivraison',
        'idAchat',
        'idStock',
        'benifice',
    ];

    // Relations

    public function client()
    {
        return $this->belongsTo(Client::class, 'idClient');
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'idFournisseur');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idProduit');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'idCategorie');
    }

    public function commande()
    {
        return $this->belongsTo(CommandeEnvoyee::class, 'idCommande');
    }

    public function livraison()
    {
        return $this->belongsTo(Livraison::class, 'idLivraison');
    }

    public function achat()
    {
        return $this->belongsTo(Achat::class, 'idAchat');
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'idStock');
    }
}
