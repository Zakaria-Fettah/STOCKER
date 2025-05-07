<?php
namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    function __construct()
{
    $this->middleware('permission:client-list|client-create|client-edit|client-delete', ['only' => ['index','store']]);
    $this->middleware('permission:client-create', ['only' => ['create','store']]);
    $this->middleware('permission:client-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:client-delete', ['only' => ['destroy']]);
}



    // Afficher la liste des clients
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $clients = Client::when($search, function ($query, $search) {
                return $query->where('nom', 'like', "%{$search}%")
                            ->orWhere('prenom', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('telephone', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        return view('clients.index', compact('clients', 'search'));
    }
    

    // Afficher le formulaire de création d'un client
    public function create()
    {
        $produits = Produit::all(); // Liste des produits
        return view('clients.create', compact('produits'));
         // Passe $produits à la vue
    }

    // Enregistrer un nouveau client
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'idProduit' => 'required|exists:produits,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'telephone' => 'required|string|max:15',
            'adresse' => 'required|string',
            'type_client' => 'required|in:particulier,entreprise',
        ]);

        // Création du client
        Client::create([
            'idProduit' => $request->idProduit,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'type_client' => $request->type_client,
        ]);

        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès.');
    }

    // Afficher les détails d'un client
    public function show($id)
    {
        $client = Client::findOrFail($id); // Charger le client par son ID
        return view('clients.show', compact('client'));
    }

    // Afficher le formulaire de modification d'un client
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $produits = Produit::all();
        return view('clients.edit', compact('client', 'produits'));
    }

    // Mettre à jour un client
    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'idProduit' => 'required|exists:produits,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            'telephone' => 'required|string|max:15',
            'adresse' => 'required|string',
            'type_client' => 'required|in:particulier,entreprise',
        ]);

        // Mise à jour du client
        $client = Client::findOrFail($id);
        $client->update([
            'idProduit' => $request->idProduit,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'type_client' => $request->type_client,
        ]);

        return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès');
    }

    // Supprimer un client
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }
}
