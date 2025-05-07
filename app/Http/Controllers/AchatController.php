<?php

// app/Http/Controllers/AchatController.php

namespace App\Http\Controllers;
use App\Models\Category;




use App\Models\Achat;
use App\Models\Produit;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class AchatController extends Controller
{

    function __construct()
{
    $this->middleware('permission:achat-list|achat-create|achat-edit|achat-delete', ['only' => ['index','store']]);
    $this->middleware('permission:achat-create', ['only' => ['create','store']]);
    $this->middleware('permission:achat-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:achat-delete', ['only' => ['destroy']]);
}



    // Afficher la liste des achats
    public function index(Request $request)
    {
        // Récupérer la valeur de la recherche
        $search = $request->input('search');
    
        // Filtrer les achats selon le critère de recherche (nom du fournisseur ou produit)
        $achats = Achat::with('produit', 'fournisseur')
            ->when($search, function ($query, $search) {
                return $query->whereHas('fournisseur', function ($subQuery) use ($search) {
                        $subQuery->where('nom', 'like', "%{$search}%")
                                 ->orWhere('prenom', 'like', "%{$search}%");
                    })
                    ->orWhereHas('produit', function ($subQuery) use ($search) {
                        $subQuery->where('nom', 'like', "%{$search}%");
                    });
            })
            ->orderBy('created_at', 'desc') // ou n'importe quel ordre de tri
            ->paginate(10); // pagination
    
        // Passer les achats et la recherche à la vue
        return view('achats.index', compact('achats', 'search'));
    }
    

    // Afficher le formulaire de création
    public function create()
    {
        
        $categories = Category::all();
        $fournisseurs = Fournisseur::all();
    $produits = Produit::all();
        return view('achats.create', compact('categories', 'fournisseurs','produits'));
    }
    

    // Enregistrer un nouvel achat
    public function store(Request $request)
    {
        $request->validate([
            'idProduit' => 'required|exists:produits,id',
            'idFournisseur' => 'required|exists:fournisseurs,id',
            'prix_achat' => 'required|numeric',
            'date_achat' => 'required|date',
            'quantite_achat' => 'required|integer',
        ]);

        Achat::create($request->all());
        return redirect()->route('achats.index');
    }

    // Afficher les détails d'un achat
    public function show(Achat $achat)
    {
        return view('achats.show', compact('achat'));
    }

    // Afficher le formulaire de modification
    public function edit(Achat $achat)
    {
        $produits = Produit::all();
        $fournisseurs = Fournisseur::all();
        return view('achats.edit', compact('achat', 'produits', 'fournisseurs'));
    }

    // Mettre à jour un achat
    public function update(Request $request, Achat $achat)
    {
        $request->validate([
            'idProduit' => 'required|exists:produits,id',
            'idFournisseur' => 'required|exists:fournisseurs,id',
            'prix_achat' => 'required|numeric',
            'date_achat' => 'required|date',
            'quantite_achat' => 'required|integer',
        ]);

        $achat->update($request->all());
        return redirect()->route('achats.index');
    }

    // Supprimer un achat
    public function destroy(Achat $achat)
    {
        $achat->delete();
        return redirect()->route('achats.index');
    }
}
