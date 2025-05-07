<?php

namespace App\Http\Controllers;

use App\Models\Livraison;
use App\Models\Client;
use App\Models\CommandeEnvoyee;
use App\Models\Category;  // Utilise 'Category' ici
use App\Models\Produit;
use Illuminate\Http\Request;

class LivraisonController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:livraison-list|livraison-create|livraison-edit|livraison-delete', ['only' => ['index','store']]);
        $this->middleware('permission:livraison-create', ['only' => ['create','store']]);
        $this->middleware('permission:livraison-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:livraison-delete', ['only' => ['destroy']]);
    }
    
    

    // Afficher la liste des livraisons
    public function index(Request $request)
{
    $search = $request->input('search');

    $livraisons = Livraison::with(['client', 'commande', 'produit', 'categorie'])
        ->when($search, function ($query) use ($search) {
            // Recherche par nom du client
            $query->whereHas('client', function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%");
            })
            // Recherche par nom du produit
            ->orWhereHas('produit', function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%");
            })
            // Recherche par nom de la catégorie
            ->orWhereHas('categorie', function ($q) use ($search) {
                $q->where('nomCategorie', 'like', "%{$search}%");
            });
        })
        ->paginate(10);

    return view('livraisons.index', compact('livraisons', 'search'));
}

    

    // Afficher le formulaire pour créer une nouvelle livraison
    public function create()
    {
        $clients = Client::all();
        $commandes = CommandeEnvoyee::all();
        $categories = Category::all();  // Utilise 'Category' ici aussi
        $produits = Produit::all();
        return view('livraisons.create', compact('clients', 'commandes', 'categories', 'produits'));
    }

    // Enregistrer une nouvelle livraison
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'statut' => 'required|in:préparée,en_cours,livrée,retardée,annulée',
            'quantite' => 'required|integer',
            'type' => 'required|string|max:255',
            'idClient' => 'required|exists:clients,id',
            'idCommande' => 'required|exists:commandes_envoyees,id',
            'idCategorie' => 'required|exists:categories,id',  // Vérifie que la table 'categories' existe
            'idProduit' => 'required|exists:produits,id',
        ]);

        Livraison::create($request->all());

        return redirect()->route('livraisons.index')->with('success', 'Livraison créée avec succès!');
    }

    // Afficher les détails d'une livraison
    public function show(Livraison $livraison)
    {
        return view('livraisons.show', compact('livraison'));
    }

    // Afficher le formulaire pour éditer une livraison
    public function edit(Livraison $livraison)
    {
        $clients = Client::all();
        $commandes = CommandeEnvoyee::all();
        $categories = Category::all();  // Utilise 'Category' ici aussi
        $produits = Produit::all();
        return view('livraisons.edit', compact('livraison', 'clients', 'commandes', 'categories', 'produits'));
    }

    // Mettre à jour une livraison
    public function update(Request $request, Livraison $livraison)
    {
        $request->validate([
            'date' => 'required|date',
            'statut' => 'required|in:préparée,en_cours,livrée,retardée,annulée',
            'quantite' => 'required|integer',
            'type' => 'required|string|max:255',
            'idClient' => 'required|exists:clients,id',
            'idCommande' => 'required|exists:commandes_envoyees,id',
            'idCategorie' => 'required|exists:categories,id',
            'idProduit' => 'required|exists:produits,id',
        ]);

        $livraison->update($request->all());

        return redirect()->route('livraisons.index')->with('success', 'Livraison mise à jour avec succès!');
    }

    // Supprimer une livraison
    public function destroy(Livraison $livraison)
    {
        $livraison->delete();
        return redirect()->route('livraisons.index')->with('success', 'Livraison supprimée avec succès!');
    }
}
