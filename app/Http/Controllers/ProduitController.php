<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Category;
use Illuminate\Http\Request;

class ProduitController extends Controller
{

    function __construct()

    {

         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','store']]);

         $this->middleware('permission:product-create', ['only' => ['create','store']]);

         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:product-delete', ['only' => ['destroy']]);

    }

    // Afficher la liste des produits avec recherche
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Produit::when($search, function ($query, $search) {
                return $query->where('nom', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('products.index', compact('products', 'search'));
    }

    public function show($id)
    {
        $product = Produit::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idcategories' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:0',
        ]);

        Produit::create($validated);

        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès');
    }

    public function edit($id)
    {
        $product = Produit::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'idcategories' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:0',
        ]);

        $produit = Produit::findOrFail($id);
        $produit->update($validated);

        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $product = Produit::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès');
    }
}
