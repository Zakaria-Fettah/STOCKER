<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{

function __construct()
{
    $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','store']]);
    $this->middleware('permission:category-create', ['only' => ['create','store']]);
    $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:category-delete', ['only' => ['destroy']]);
}


    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::when($search, function ($query, $search) {
                return $query->where('nomCategorie', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('categories.index', compact('categories', 'search'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomCategorie' => 'required|string|max:255',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès !');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'nomCategorie' => 'required|string|max:255',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès !');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès !');
    }

    public function getProduits($id)
    {
        $produits = Produit::where('idcategories', $id)->get();
        return response()->json($produits);
    }
}
