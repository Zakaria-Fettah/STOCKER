<?php

namespace App\Http\Controllers;

use App\Models\CommandeEnvoyee;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;

class CommandesEnvoyeesController extends Controller
{

    function __construct()
{
    $this->middleware('permission:commande_envoyee-list|commande_envoyee-create|commande_envoyee-edit|commande_envoyee-delete', ['only' => ['index','store']]);
    $this->middleware('permission:commande_envoyee-create', ['only' => ['create','store']]);
    $this->middleware('permission:commande_envoyee-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:commande_envoyee-delete', ['only' => ['destroy']]);
}



    // Afficher le formulaire pour créer une nouvelle commande envoyée
    public function create()
    {
        // Récupère tous les clients de la base de données
        $clients = Client::all();
    
        // Passe la variable $clients à la vue
        return view('commandes_envoyees.create', compact('clients'));
    }

    // Enregistrer une nouvelle commande envoyée avec création automatique du client
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'dateCommande' => 'required|date',
            'client_id' => 'required|exists:clients,id', // Vérifie que client_id existe dans la table clients
            'statut' => 'required|in:en_attente,envoyée,annulée,livrée',
        ]);
    
        // Création de la commande envoyée
        CommandeEnvoyee::create([
            'dateCommande' => $request->dateCommande,
            'statut' => $request->statut,
            'client_id' => $request->client_id, // Assurez-vous que client_id est inclus
        ]);
    
        return redirect()->route('commandes_envoyees.index')->with('success', 'Commande envoyée ajoutée avec succès.');
    }
    

    // Afficher toutes les commandes envoyées
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $commandes = CommandeEnvoyee::with('client')
            ->when($search, function ($query, $search) {
                $query->whereHas('client', function ($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%");
                    // ->orWhere('CIN', 'like', "%{$search}%"); // décommente cette ligne uniquement si `CIN` existe dans la table `clients`
                });
            })
            ->orderBy('dateCommande', 'desc')
            ->paginate(10);
    
        return view('commandes_envoyees.index', compact('commandes', 'search'));
    }
    

    
    // Afficher les détails d'une commande envoyée
    public function show($id)
    {
        $commande = CommandeEnvoyee::with('client')->findOrFail($id);
        return view('commandes_envoyees.show', compact('commande'));
    }

    // Formulaire d'édition
    public function edit($id)
    {
        // Récupérer la commande envoyée avec son client
        $commande = CommandeEnvoyee::findOrFail($id);
    
        // Récupérer tous les clients
        $clients = Client::all();
    
        // Passer la commande et les clients à la vue
        return view('commandes_envoyees.edit', compact('commande', 'clients'));
    }
    

    // Mise à jour
    public function update(Request $request, $id)
    {
        $request->validate([
            'dateCommande' => 'required|date',
            'statut' => 'required|in:en_attente,envoyée,annulée,livrée',
        ]);

        $commande = CommandeEnvoyee::findOrFail($id);
        $commande->update([
            'dateCommande' => $request->dateCommande,
            'statut' => $request->statut,
        ]);

        return redirect()->route('commandes_envoyees.index')->with('success', 'Commande envoyée mise à jour avec succès.');
    }

    // Suppression
    public function destroy($id)
    {
        $commande = CommandeEnvoyee::findOrFail($id);
        $commande->delete();

        return redirect()->route('commandes_envoyees.index')->with('success', 'Commande envoyée supprimée avec succès.');
    }
}
