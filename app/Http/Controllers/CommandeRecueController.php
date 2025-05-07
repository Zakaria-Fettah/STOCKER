<?php

// app/Http/Controllers/CommandeRecueController.php

namespace App\Http\Controllers;

use App\Models\CommandeRecue;
use App\Models\Achat;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class CommandeRecueController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:commande_recue-list|commande_recue-create|commande_recue-edit|commande_recue-delete', ['only' => ['index','store']]);
        $this->middleware('permission:commande_recue-create', ['only' => ['create','store']]);
        $this->middleware('permission:commande_recue-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:commande_recue-delete', ['only' => ['destroy']]);
    }
    
    

    // Afficher la liste des commandes reçues
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $commandes = CommandeRecue::with('achat', 'fournisseur')
            ->when($search, function ($query, $search) {
                return $query->whereHas('fournisseur', function ($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%")
                    ->orWhere('prenom', 'like', "%{$search}%");
                })->orWhereHas('achat', function ($q) use ($search) {
                    $q->where('id', 'like', "%{$search}%");
                });
                
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        return view('commande_recues.index', compact('commandes', 'search'));
    }
    

    // Afficher le formulaire de création
    public function create()
    {
        $achats = Achat::all(); // Récupérer les achats pour les afficher dans un select
        $fournisseurs = Fournisseur::all(); // Récupérer les fournisseurs pour les afficher dans un select
        return view('commande_recues.create', compact('achats', 'fournisseurs'));
    }

    // Enregistrer une nouvelle commande reçue
    public function store(Request $request)
    {
        $request->validate([
            'idFournisseur' => 'required|exists:fournisseurs,id',
            'quantite' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'idAchat' => 'required|exists:achats,id',
            'dateCommande' => 'required|date',
            'statut' => 'required|in:en_attente,en_cours,livrée,annulée',
        ]);

        CommandeRecue::create([
            'idFournisseur' => $request->idFournisseur,
            'quantite' => $request->quantite,
            'prix' => $request->prix,
            'idAchat' => $request->idAchat,
            'dateCommande' => $request->dateCommande,
            'statut' => $request->statut,
        ]);

        return redirect()->route('commande-recues.index');
    }

    // Afficher les détails d'une commande reçue
    public function show(CommandeRecue $commandeRecue)
    {
        return view('commande_recues.show', compact('commandeRecue'));
    }

    // Afficher le formulaire de modification
    public function edit(CommandeRecue $commandeRecue)
    {
        $achats = Achat::all();
        $fournisseurs = Fournisseur::all();
        return view('commande_recues.edit', compact('commandeRecue', 'achats', 'fournisseurs'));
    }

    // Mettre à jour une commande reçue
    public function update(Request $request, CommandeRecue $commandeRecue)
    {
        $request->validate([
            'idFournisseur' => 'required|exists:fournisseurs,id',
            'quantite' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'idAchat' => 'required|exists:achats,id',
            'dateCommande' => 'required|date',
            'statut' => 'required|in:en_attente,en_cours,livrée,annulée',
        ]);

        $commandeRecue->update([
            'idFournisseur' => $request->idFournisseur,
            'quantite' => $request->quantite,
            'prix' => $request->prix,
            'idAchat' => $request->idAchat,
            'dateCommande' => $request->dateCommande,
            'statut' => $request->statut,
        ]);
        return redirect()->route('commande-recues.index');    }

    // Supprimer une commande reçue
    public function destroy(CommandeRecue $commandeRecue)
    {
        $commandeRecue->delete();
        return redirect()->route('commande-recues.index');
    }
}
