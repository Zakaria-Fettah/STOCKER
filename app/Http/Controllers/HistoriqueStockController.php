<?php

namespace App\Http\Controllers;

use App\Models\HistoriqueStock;
use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\CommandeEnvoyee;
use App\Models\Livraison;
use App\Models\Achat;
use App\Models\Stock;
use Illuminate\Http\Request;

class HistoriqueStockController extends Controller
{
    public function index()
    {
        $historiques = HistoriqueStock::with(['client', 'fournisseur', 'produit'])->get();
        return view('historique_stocks.index', compact('historiques'));
    }

    public function create()
    {
        return view('historique_stocks.create', [
            'clients' => Client::all(),
            'fournisseurs' => Fournisseur::all(),
            'produits' => Produit::all(),
            'categories' => Categorie::all(),
            'commandes' => CommandeEnvoyee::all(),
            'livraisons' => Livraison::all(),
            'achats' => Achat::all(),
            'stocks' => Stock::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'idClient' => 'required|exists:clients,id',
            'idFournisseur' => 'required|exists:fournisseurs,id',
            'idProduit' => 'required|exists:produits,id',
            'idCategorie' => 'required|exists:categories,id',
            'idCommande' => 'required|exists:commandes_envoyees,id',
            'idLivraison' => 'required|exists:livraisons,id',
            'idAchat' => 'required|exists:achats,id',
            'idStock' => 'required|exists:stock,id',
            'benifice' => 'required|numeric',
        ]);

        HistoriqueStock::create($request->all());

        return redirect()->route('historique-stocks.index')->with('success', 'Historique ajouté avec succès.');
    }

    public function show(HistoriqueStock $historiqueStock)
    {
        $historiqueStock->load(['client', 'fournisseur', 'produit', 'categorie', 'commande', 'livraison', 'achat', 'stock']);
        return view('historique_stocks.show', compact('historiqueStock'));
    }

    public function edit(HistoriqueStock $historiqueStock)
    {
        return view('historique_stocks.edit', [
            'historiqueStock' => $historiqueStock,
            'clients' => Client::all(),
            'fournisseurs' => Fournisseur::all(),
            'produits' => Produit::all(),
            'categories' => Categorie::all(),
            'commandes' => CommandeEnvoyee::all(),
            'livraisons' => Livraison::all(),
            'achats' => Achat::all(),
            'stocks' => Stock::all(),
        ]);
    }

    public function update(Request $request, HistoriqueStock $historiqueStock)
    {
        $request->validate([
            'idClient' => 'required|exists:clients,id',
            'idFournisseur' => 'required|exists:fournisseurs,id',
            'idProduit' => 'required|exists:produits,id',
            'idCategorie' => 'required|exists:categories,id',
            'idCommande' => 'required|exists:commandes_envoyees,id',
            'idLivraison' => 'required|exists:livraisons,id',
            'idAchat' => 'required|exists:achats,id',
            'idStock' => 'required|exists:stock,id',
            'benifice' => 'required|numeric',
        ]);

        $historiqueStock->update($request->all());

        return redirect()->route('historique-stocks.index')->with('success', 'Historique mis à jour.');
    }

    public function destroy(HistoriqueStock $historiqueStock)
    {
        $historiqueStock->delete();
        return redirect()->route('historique-stocks.index')->with('success', 'Historique supprimé.');
    }
}
