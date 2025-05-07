<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\CommandeRecue;
use App\Models\CommandeEnvoyee;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\Vente;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Comptage des éléments (statistiques existantes)
        $totalCategories = Category::count();
        $totalUsers = User::count();
        $totalCommandesRecues = CommandeRecue::count();
        $totalCommandesEnvoyees = CommandeEnvoyee::count();
        $totalClients = Client::count();
        $totalProduits = Produit::count();
        $totalStock = Stock::count(); // Changé de sum('id') à count()
        $totalVentes = Vente::count();
        $totalAchats = CommandeRecue::sum('prix');
        $totalAchats = CommandeRecue::whereNotNull('prix')->sum('prix');



        // Nouvelles statistiques pour les ventes et bénéfices
        $montantTotalVentes = Vente::sum('total');
        $beneficeTotalVentes = Vente::sum('benifice');
        $moyenneAchat = $totalVentes > 0 ? $montantTotalVentes / $totalVentes : 0;

        // Récupérer les ventes et bénéfices des 12 derniers mois pour le graphique
        $ventesParMois = Vente::select(
            DB::raw('MONTH(created_at) as mois'), 
            DB::raw('YEAR(created_at) as annee'),
            DB::raw('SUM(total) as total_ventes'),
            DB::raw('SUM(benifice) as total_benifice')
        )
        ->whereDate('created_at', '>=', Carbon::now()->subMonths(12))
        ->groupBy('annee', 'mois')
        ->orderBy('annee')
        ->orderBy('mois')
        ->get();

        // Formatter les données pour les graphiques
        $labels = [];
        $dataVentes = [];
        $dataBenifices = [];

        foreach ($ventesParMois as $vente) {
            $date = Carbon::createFromDate($vente->annee, $vente->mois, 1);
            $labels[] = $date->format('M Y');
            $dataVentes[] = $vente->total_ventes;
            $dataBenifices[] = $vente->total_benifice;
        }

        // Top produits vendus
        $topProduits = Vente::select(
            'produits.nom',
            DB::raw('SUM(ventes.quantiteVendue) as quantite_totale'),
            DB::raw('SUM(ventes.total) as montant_total')
        )
        ->join('produits', 'ventes.idProduit', '=', 'produits.id')
        ->groupBy('produits.id', 'produits.nom')
        ->orderBy('quantite_totale', 'desc')
        ->limit(5)
        ->get();

        // Top clients
        $topClients = Vente::select(
            'clients.nom',
            DB::raw('SUM(ventes.total) as montant_total')
        )
        ->join('clients', 'ventes.idClient', '=', 'clients.id')
        ->groupBy('clients.id', 'clients.nom')
        ->orderBy('montant_total', 'desc')
        ->limit(5)
        ->get();

        // Ventes par jour de la semaine dernière
        $ventesSemaine = Vente::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as total_ventes'),
            DB::raw('SUM(benifice) as total_benifice')
        )
        ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $labelsSemaine = [];
        $dataVentesSemaine = [];
        $dataBenificesSemaine = [];

        foreach ($ventesSemaine as $vente) {
            $labelsSemaine[] = Carbon::parse($vente->date)->format('d/m');
            $dataVentesSemaine[] = $vente->total_ventes;
            $dataBenificesSemaine[] = $vente->total_benifice;
        }

        // Envoi à la vue
        return view('dashboard', compact(
            'totalCategories',
            'totalUsers',
            'totalCommandesRecues',
            'totalCommandesEnvoyees',
            'totalClients',
            'totalProduits',
            'totalStock',
            'totalAchats',
            'totalVentes',
            'montantTotalVentes',
            'beneficeTotalVentes',
            'moyenneAchat',
            'labels',
            'totalAchats',  // Vérifie que tu as bien ajouté cette ligne

            'dataVentes',
            'dataBenifices',
            'topProduits',
            'topClients',
            'labelsSemaine',
            'dataVentesSemaine',
            'dataBenificesSemaine'
        ));
    }

    public function getVentesDonnees(Request $request)
    {
        $periode = $request->periode ?? 'mois';
        $debutPeriode = Carbon::now();
        
        switch ($periode) {
            case 'semaine':
                $debutPeriode = $debutPeriode->subDays(7);
                $groupBy = 'DATE(created_at)';
                $format = 'd/m';
                break;
            case 'mois':
                $debutPeriode = $debutPeriode->subMonth();
                $groupBy = 'DATE(created_at)';
                $format = 'd/m';
                break;
            case 'annee':
                $debutPeriode = $debutPeriode->subYear();
                $groupBy = 'MONTH(created_at)';
                $format = 'M';
                break;
            default:
                $debutPeriode = $debutPeriode->subMonth();
                $groupBy = 'DATE(created_at)';
                $format = 'd/m';
        }

        $ventes = Vente::select(
            DB::raw("$groupBy as date"),
            DB::raw('SUM(total) as total_ventes'),
            DB::raw('SUM(benifice) as total_benifice')
        )
        ->whereDate('created_at', '>=', $debutPeriode)
        ->groupBy(DB::raw($groupBy))
        ->orderBy(DB::raw($groupBy))
        ->get();

        $data = [
            'labels' => [],
            'ventes' => [],
            'benifices' => []
        ];

        foreach ($ventes as $vente) {
            if ($periode == 'annee') {
                $dateFormatee = Carbon::createFromFormat('m', $vente->date)->format($format);
            } else {
                $dateFormatee = Carbon::parse($vente->date)->format($format);
            }
            
            $data['labels'][] = $dateFormatee;
            $data['ventes'][] = $vente->total_ventes;
            $data['benifices'][] = $vente->total_benifice;
        }

        return response()->json($data);
    }
}