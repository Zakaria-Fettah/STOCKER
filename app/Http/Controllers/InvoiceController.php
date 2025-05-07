<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Vente;

class InvoiceController extends Controller
{
    public function generatePDF($venteId)
    {
        // Récupérer la vente avec ses relations
        $vente = Vente::with('client', 'produit', 'stock')->findOrFail($venteId);

        // Calculer la TVA (20%) et le total HT
        $totalHT = $vente->total / 1.2; // Total HT = Total TTC / 1.2 (car TVA 20%)
        $tva = $vente->total - $totalHT; // TVA = Total TTC - Total HT

        // Préparer les items pour le tableau de la facture
        $items = [
            [
                'designation' => $vente->produit->nom ?? 'Produit inconnu',
                'quantity' => $vente->quantiteVendue,
                'price' => $vente->prixUnitaire,
                'total' => $vente->quantiteVendue * $vente->prixUnitaire,
            ]
        ];

        // Préparer les données pour la vue
        $data = [
            'invoiceNumber' => $vente->id + 551, // Par exemple, pour commencer à 552
            'date' => $vente->created_at->format('d/m/Y'),
            'dueDate' => $vente->created_at->addMonth()->format('d/m/Y'),
            'client_name' => $vente->client->nom ?? 'Client inconnu', // Utilisation de 'name' pour correspondre à ton modèle
            'client_address' => $vente->client->adresse ?? 'Adresse inconnue',
            'client_siret' => $vente->client->siret ?? 'Non spécifié',
            'client_vat' => $vente->client->vat ?? 'Non spécifié',
            'items' => $items,
            'totalHT' => $totalHT,
            'tva' => $tva,
            'totalTTC' => $vente->total,
        ];

        // Charger la vue et générer le PDF
        $pdf = PDF::loadView('invoice', $data);

        // Télécharger le PDF
        return $pdf->download("facture_{$vente->id}.pdf");
    }
}