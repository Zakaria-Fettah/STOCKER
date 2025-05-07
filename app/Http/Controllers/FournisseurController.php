<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:fournisseur-list|fournisseur-create|fournisseur-edit|fournisseur-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:fournisseur-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:fournisseur-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:fournisseur-delete', ['only' => ['destroy']]);
    }

    // Afficher la liste des fournisseurs avec recherche
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $fournisseurs = Fournisseur::with('produits') // Charger les produits associés
            ->when($search, function ($query, $search) {
                return $query->where('nom', 'like', "%{$search}%")
                            ->orWhere('prenom', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('telephone', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        return view('fournisseurs.index', compact('fournisseurs', 'search'));
    }
    

    // Formulaire de création
    public function create()
    {
        $produits = Produit::all(); // pour la vue
        return view('fournisseurs.create', compact('produits'));
    }

    // Enregistrement d'un nouveau fournisseur
    public function store(Request $request)
    {
        $request->validate([
            'produits' => 'required|array',  // Ensure produits is an array
            'produits.*' => 'exists:produits,id', // Validate that each product ID exists
            'nom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'genre' => 'required',
            'condition_payement' => 'required',
            'date_livraison' => 'required|date',
            'fiabilite' => 'required',
        ]);

        // Create the fournisseur
        $fournisseur = Fournisseur::create($request->all());

        // Attach the products to the fournisseur (many-to-many relation)
        $fournisseur->produits()->attach($request->input('produits'));

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur ajouté avec succès');
    }

    // Afficher les détails
    public function show(Fournisseur $fournisseur)
    {
        return view('fournisseurs.show', compact('fournisseur'));
    }

    // Formulaire d'édition
    public function edit(Fournisseur $fournisseur)
    {
        $produits = Produit::all();
        return view('fournisseurs.edit', compact('fournisseur', 'produits'));
    }

    // Mise à jour
    public function update(Request $request, Fournisseur $fournisseur)
    {
        $request->validate([
            'produits' => 'required|array',  // Ensure produits is an array
            'produits.*' => 'exists:produits,id', // Validate that each product ID exists
            'nom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'genre' => 'required',
            'condition_payement' => 'required',
            'date_livraison' => 'required|date',
            'fiabilite' => 'required',
        ]);

        // Update fournisseur data
        $fournisseur->update($request->all());

        // Sync the products (many-to-many relation)
        $fournisseur->produits()->sync($request->input('produits'));

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur mis à jour avec succès');
    }

    // Suppression
    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();
        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur supprimé avec succès');
    }
}
