<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Commande;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    // Afficher la liste des factures
    public function index()
    {
        $factures = Facture::all();
        return view('factures.index', compact('factures'));
    }

    // Afficher les détails d'une facture
    public function show($id)
    {
        $facture = Facture::findOrFail($id);
        return view('factures.show', compact('facture'));
    }

    // Formulaire de création d'une facture manuelle
    public function create()
    {
        $commandes = Commande::all();
        return view('factures.create', compact('commandes'));
    }

    // Enregistrer une nouvelle facture
    public function store(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'numero_facture' => 'required|unique:factures,numero_facture',
            'date_facture' => 'required|date',
            'montant_total' => 'required|numeric',
            'statut' => 'required|string',
        ]);

        Facture::create([
            'commande_id' => $request->commande_id,
            'numero_facture' => $request->numero_facture,
            'date_facture' => $request->date_facture,
            'montant_total' => $request->montant_total,
            'statut' => $request->statut,
        ]);

        return redirect()->route('factures.index')->with('success', 'Facture créée avec succès.');
    }

    // Générer une facture automatiquement depuis une commande
    public function generateInvoice($commandeId)
    {
        $commande = Commande::findOrFail($commandeId);

        // Calcul du montant total depuis les produits liés
        $montantTotal = $commande->produits->sum(function($produit) {
            return $produit->pivot->quantite * $produit->prix;
        });

        // Création de la facture
        $facture = Facture::create([
            'commande_id' => $commande->id,
            'numero_facture' => 'FAC-' . str_pad($commande->id, 5, '0', STR_PAD_LEFT),
            'date_facture' => now(),
            'montant_total' => $montantTotal,
            'statut' => 'en_attente',
        ]);

        return redirect()->route('factures.index')->with('success', 'Facture générée automatiquement.');
    }

    // Exporter une facture en PDF
    public function generatePDF($id)
    {
        $facture = Facture::findOrFail($id);
        $pdf = PDF::loadView('factures.pdf', compact('facture'));
        return $pdf->download('facture-' . $facture->numero_facture . '.pdf');
    }
}
