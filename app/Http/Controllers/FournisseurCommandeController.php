<?php
// app/Http/Controllers/FournisseurCommandeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FournisseurCommande;
use App\Models\CommandeRecue;
use App\Models\Fournisseur;

class FournisseurCommandeController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:fournir_commande-list|fournir_commande-create|fournir_commande-edit|fournir_commande-delete', ['only' => ['index','store']]);
        $this->middleware('permission:fournir_commande-create', ['only' => ['create','store']]);
        $this->middleware('permission:fournir_commande-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:fournir_commande-delete', ['only' => ['destroy']]);
    }
    
    




    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $fournisseurCommandes = FournisseurCommande::with(['commandeRecue', 'fournisseur'])
            ->when($search, function ($query, $search) {
                $query->whereHas('fournisseur', function ($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%");
                })
                ->orWhereHas('commandeRecue', function ($q) use ($search) {
                    $q->where('statut', 'like', "%{$search}%"); // ou un autre champ réel dans commandeRecue
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        return view('fournisseurcommande.index', compact('fournisseurCommandes', 'search'));
    }
    


    public function create()
    {
        // Récupérer toutes les commandes reçues et tous les fournisseurs
        $commandesRecue = CommandeRecue::all();
        $fournisseurs = Fournisseur::all();

        // Passer les données à la vue
        return view('fournisseurcommande.create', compact('commandesRecue', 'fournisseurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idCommande' => 'required|exists:commande_recues,id',
            'idFournisseur' => 'required|exists:fournisseurs,id',
        ]);

        FournisseurCommande::create($request->all());

        return redirect()->route('fournisseurcommande.index')->with('success', 'Liaison ajoutée.');
    }

    public function edit($id)
    {
        // Trouve la commande fournisseur par son ID
        $fournisseurCommande = FournisseurCommande::findOrFail($id);
    
        // Récupère toutes les commandes reçues et fournisseurs pour les afficher dans le formulaire
        $commandesRecues = CommandeRecue::all();
        $fournisseurs = Fournisseur::all();
    
        // Passe les données à la vue
        return view('fournisseurcommande.edit', compact('fournisseurCommande', 'commandesRecues', 'fournisseurs'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'idCommande' => 'required|exists:commande_recues,id',
            'idFournisseur' => 'required|exists:fournisseurs,id',
        ]);

        $liaison = FournisseurCommande::findOrFail($id);
        $liaison->update($request->all());

        return redirect()->route('fournisseurcommande.index')->with('success', 'Liaison mise à jour.');
    }

    public function destroy($id)
    {
        $liaison = FournisseurCommande::findOrFail($id);
        $liaison->delete();

        return redirect()->route('fournisseurcommande.index')->with('success', 'Liaison supprimée.');
    }
}
