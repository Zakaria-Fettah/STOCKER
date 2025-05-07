<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Produit;
use App\Models\Client;
use App\Models\Stock;
use Illuminate\Http\Request;

class VenteController extends Controller
{



    function __construct()
    {
        $this->middleware('permission:vente-list|vente-create|vente-edit|vente-delete', ['only' => ['index','store']]);
        $this->middleware('permission:vente-create', ['only' => ['create','store']]);
        $this->middleware('permission:vente-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:vente-delete', ['only' => ['destroy']]);
    }
    
    


    // Afficher toutes les ventes
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $ventes = Vente::with(['produit', 'client', 'stock'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('client', function ($q) use ($search) {
                            $q->where('nom', 'like', "%{$search}%");
                        })
                        ->orWhereHas('produit', function ($q) use ($search) {
                            $q->where('nom', 'like', "%{$search}%");
                        });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        return view('ventes.index', compact('ventes', 'search'));
    }
    
    // Afficher le formulaire de création de vente
    public function create()
    {
        $produits = Produit::all();
        $clients = Client::all();
        $stocks = Stock::all();
        return view('ventes.create', compact('produits', 'clients', 'stocks'));
    }

    // Afficher les détails d'une vente
public function show($id)
{
    $vente = Vente::with(['produit', 'client', 'stock'])->findOrFail($id);
    return view('ventes.show', compact('vente'));
}
    // Enregistrer une nouvelle vente
    // Dans la méthode store()
public function store(Request $request)
{
    $request->validate([
        'idProduit' => 'required|exists:produits,id',
        'idClient' => 'required|exists:clients,id',
        'idStock' => 'required|exists:stocks,id',
        'quantiteVendue' => 'required|integer|min:1',
        'prixUnitaire' => 'required|numeric',
    ]);

    // Récupérer le produit et le stock
    $produit = Produit::find($request->idProduit);
    $stock = Stock::find($request->idStock);

    // Vérifier si la quantité demandée est disponible en stock
    if ($request->quantiteVendue > $stock->quantite) {
        return back()->withErrors(['quantiteVendue' => 'La quantité demandée dépasse le stock disponible.']);
    }

    // Vérifier que le prix de vente est supérieur ou égal au prix d'achat
    if ($request->prixUnitaire < $produit->prix) {
        return back()->withErrors(['prixUnitaire' => 'Le prix de vente ne peut pas être inférieur au prix d\'achat.']);
    }

    // Calcul du total et du bénéfice
    $total = $request->quantiteVendue * $request->prixUnitaire;
    $benifice = $total * 0.2;  // Exemple de calcul de bénéfice

    // Créer la vente
    Vente::create([
        'idProduit' => $request->idProduit,
        'idClient' => $request->idClient,
        'idStock' => $request->idStock,
        'quantiteVendue' => $request->quantiteVendue,
        'prixUnitaire' => $request->prixUnitaire,
        'total' => $total,
        'benifice' => $benifice
    ]);

    // Mettre à jour le stock après la vente
    $stock->quantite -= $request->quantiteVendue;
    $stock->save();

    return redirect()->route('ventes.index')->with('success', 'Vente ajoutée avec succès');
}


    // Afficher le formulaire d'édition de vente
    public function edit($id)
    {
        $vente = Vente::findOrFail($id);
        $produits = Produit::all();
        $clients = Client::all();
        $stocks = Stock::all();
        return view('ventes.edit', compact('vente', 'produits', 'clients', 'stocks'));
    }

    // Mettre à jour une vente
    public function update(Request $request, $id)
    {
        $request->validate([
            'idProduit' => 'required|exists:produits,id',
            'idClient' => 'required|exists:clients,id',
            'idStock' => 'required|exists:stocks,id',
            'quantiteVendue' => 'required|integer|min:1',
            'prixUnitaire' => 'required|numeric',
        ]);

        $vente = Vente::findOrFail($id);
        $total = $request->quantiteVendue * $request->prixUnitaire;
        $benifice = $total * 0.2;

        $vente->update([
            'idProduit' => $request->idProduit,
            'idClient' => $request->idClient,
            'idStock' => $request->idStock,
            'quantiteVendue' => $request->quantiteVendue,
            'prixUnitaire' => $request->prixUnitaire,
            'total' => $total,
            'benifice' => $benifice
        ]);

        return redirect()->route('ventes.index')->with('success', 'Vente mise à jour avec succès');
    }
    public function getProduitPrice($id)
    {
        $produit = Produit::findOrFail($id);
        return response()->json(['prix' => $produit->prix]);
    }
    
    // Supprimer une vente
    public function destroy($id)
    {
        $vente = Vente::findOrFail($id);
        $vente->delete();
        return redirect()->route('ventes.index')->with('success', 'Vente supprimée avec succès');
    }
}
