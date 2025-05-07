<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Produit;
use App\Models\Category; // Updated to Categorie to match French naming
use Illuminate\Http\Request;

class StockController extends Controller
{

    function __construct()
{
    $this->middleware('permission:stock-list|stock-create|stock-edit|stock-delete', ['only' => ['index','store']]);
    $this->middleware('permission:stock-create', ['only' => ['create','store']]);
    $this->middleware('permission:stock-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:stock-delete', ['only' => ['destroy']]);
}


    public function index(Request $request)
{
    $search = $request->input('search');

    $stocks = Stock::with(['produit', 'categorie'])
        ->when($search, function ($query, $search) {
            return $query->whereHas('produit', function ($q) use ($search) {
                        $q->where('nom', 'like', "%{$search}%");
                    })
                    ->orWhereHas('categorie', function ($q) use ($search) {
                        $q->where('nomCategorie', 'like', "%{$search}%");
                    });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('stocks.index', compact('stocks', 'search'));
}


    public function create()
    {
        $produits = Produit::all(); // Récupérer tous les produits
        $categories = Category::all(); // Récupérer toutes les catégories
        return view('stocks.create', compact('produits', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idProduit' => 'required|exists:produits,id',
            'idCategorie' => 'required|exists:categories,id',
            'quantite' => 'required|integer|min:0',
            'description' => 'nullable|string|max:1000', // Validation pour description
        ]);

        Stock::create($request->only(['idProduit', 'idCategorie', 'quantite', 'description']));

        return redirect()->route('stocks.index')->with('success', 'Stock créé avec succès.');
    }

    public function show($id)
    {
        $stock = Stock::with(['produit', 'categorie'])->findOrFail($id);
        return view('stocks.show', compact('stock'));
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        $produits = Produit::all();
        $categories = Category::all();
        return view('stocks.edit', compact('stock', 'produits', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idProduit' => 'required|exists:produits,id',
            'idCategorie' => 'required|exists:categories,id',
            'quantite' => 'required|integer|min:0',
            'description' => 'nullable|string|max:1000', // Validation pour description
        ]);

        $stock = Stock::findOrFail($id);
        $stock->update($request->only(['idProduit', 'idCategorie', 'quantite', 'description']));

        return redirect()->route('stocks.index')->with('success', 'Stock mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Stock supprimé avec succès.');
    }
}