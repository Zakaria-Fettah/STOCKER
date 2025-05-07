@extends('layout.mainlayout')
@section('content')
<div class="container-fluid" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
    <!-- Afficher Bonjour à l'utilisateur connecté -->
    <div class="text-center mb-4">
        @if(Auth::check())
            @php
                $hour = date('H'); // Récupère l'heure actuelle (24h)
            @endphp
            @if($hour < 18)
                <h1 style="font-size: 3rem;">Bonjour, {{ Auth::user()->name }} !</h1>
            @else
                <h1 style="font-size: 3rem;">Bonsoir, {{ Auth::user()->name }} !</h1>
            @endif
        @else
            @php
                $hour = date('H'); // Récupère l'heure actuelle (24h)
            @endphp
            @if($hour < 18)
                <h1 style="font-size: 3rem;">Bonjour, invité !</h1>
            @else
                <h1 style="font-size: 3rem;">Bonsoir, invité !</h1>
            @endif
        @endif

    <h1 class="mb-4">Tableau de bord</h1>
    
    <!-- Statistiques existantes -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Catégories</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCategories }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Produits</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProduits }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Clients</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalClients }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Ventes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalVentes }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Utilisateurs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Commandes Reçues</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCommandesRecues }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-inbox fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Commandes Envoyées</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCommandesEnvoyees }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-paper-plane fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Stock</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalStock }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-warehouse fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Nouvelles cartes pour les statistiques de ventes -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total des ventes</h5>
                    <h2>{{ number_format($montantTotalVentes, 2) }} DH</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total des bénéfices</h5>
                    <h2>{{ number_format($beneficeTotalVentes, 2) }} DH</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
    <div class="card bg-info text-white">
        <div class="card-body">
            <h5 class="card-title">Total Achats</h5>
            <h2>{{ number_format($totalAchats, 2) }} DH</h2>
        </div>
    </div>
</div>


    

    <!-- Top produits et clients -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top 5 des produits vendus</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topProduits->take(5) as $produit)
                            <tr>
                                <td>{{ $produit->nom }}</td>
                                <td>{{ $produit->quantite_totale }}</td>
                                <td>{{ number_format($produit->montant_total, 2) }} DH</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Top 5 des clients</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Montant total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topClients->take(5) as $client)
                    <tr>
                        <td>{{ $client->nom }}</td>
                        <td>{{ number_format($client->montant_total, 2) }} DH</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    <div class="card mb-4">
    <div class="card-header">
        <h5>Ventes par jour (7 derniers jours)</h5>
    </div>
    <div class="card-body">
        <canvas id="ventesJourChart" height="100"></canvas>
    </div>
</div>

<!-- Ajoute ce script juste avant la fin de ta page -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctxJour = document.getElementById('ventesJourChart').getContext('2d');
    const ventesJourChart = new Chart(ctxJour, {
        type: 'line',
        data: {
            labels: @json($labelsSemaine),
            datasets: [
                {
                    label: 'Total Ventes',
                    data: @json($dataVentesSemaine),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Total Bénéfices',
                    data: @json($dataBenificesSemaine),
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Evolution des Ventes et Bénéfices'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
    // Variables pour les graphiques
    let ventesChart;
    let repartitionChart;
    let ventesWeekChart;
    
    // Données initiales
    const initialLabels = @json($labels);
    const initialVentes = @json($dataVentes);
    const initialBenefices = @json($dataBenifices);
    
    // Données de la semaine
    const weekLabels = @json($labelsSemaine);
    const weekVentes = @json($dataVentesSemaine);
    const weekBenefices = @json($dataBenificesSemaine);
    
    // Fonction pour initialiser les graphiques
    function initCharts() {
        // Graphique d'évolution
        const ventesCtx = document.getElementById('ventesChart').getContext('2d');
        ventesChart = new Chart(ventesCtx, {
            type: 'line',
            data: {
                labels: initialLabels,
                datasets: [
                    {
                        label: 'Ventes',
                        data: initialVentes,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    },
                    {
                        label: 'Bénéfices',
                        data: initialBenefices,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Graphique de répartition des ventes
        const repartitionCtx = document.getElementById('repartitionChart').getContext('2d');
        repartitionChart = new Chart(repartitionCtx, {
            type: 'pie',
            data: {
                labels: initialLabels,
                datasets: [
                    {
                        data: initialVentes,
                        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
                        borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                        borderWidth: 1
                    }
                ]
            }
        });

        // Graphique des ventes de la semaine
        const ventesWeekCtx = document.getElementById('ventesWeekChart').getContext('2d');
        ventesWeekChart = new Chart(ventesWeekCtx, {
            type: 'line',
            data: {
                labels: weekLabels,
                datasets: [
                    {
                        label: 'Ventes semaine',
                        data: weekVentes,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2
                    },
                    {
                        label: 'Bénéfices semaine',
                        data: weekBenefices,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', initCharts);
</script>
@endsection
