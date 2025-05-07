@extends('layout.mainlayout')

@section('content')
    <div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 100px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Liste des Commandes Reçues</h2>
            <a href="{{ route('commande-recues.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Ajouter une commande
            </a>
        </div>

        {{-- Search Form --}}
        <form method="GET" action="{{ route('commande-recues.index') }}" class="input-group mb-4" style="max-width: 400px;">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par fournisseur ou achat..." value="{{ old('search', $search ?? '') }}">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <div class="card shadow-sm">
            <div class="card-body">
                @if ($commandes->isEmpty())
                    <div class="alert alert-warning text-center">
                        Aucune commande trouvée pour votre recherche.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Fournisseur</th>
                                    <th>Quantité</th>
                                    <th>Prix D'achat</th>
                                    <th>Achat</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commandes as $commande)
                                    <tr>
                                        <td>{{ $commande->fournisseur->nom ?? 'N/A' }}</td>
                                        <td>{{ $commande->quantite }}</td>
                                        <td>{{ number_format($commande->prix, 2) }} DH</td>
                                        <td>{{ $commande->achat->id ?? 'N/A' }}</td>
                                        <td>{{ $commande->dateCommande ? \Carbon\Carbon::parse($commande->dateCommande)->format('d/m/Y') : 'N/A' }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($commande->statut == 'livré') bg-success 
                                                @elseif($commande->statut == 'en cours') bg-warning text-dark 
                                                @elseif($commande->statut == 'annulé') bg-danger 
                                                @else bg-secondary @endif">
                                                {{ $commande->statut }}
                                            </span>
                                        </td>
                                        <td>
                                            <!-- Voir Button -->
                                            <a href="{{ route('commande-recues.show', $commande->id) }}" class="btn btn-info" title="Voir">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <!-- Modifier Button -->
                                            <a href="{{ route('commande-recues.edit', $commande->id) }}" class="btn btn-warning" title="Modifier">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <!-- Supprimer Button -->
                                            <form action="{{ route('commande-recues.destroy', $commande->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Supprimer">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Pagination --}}
        @if (!$commandes->isEmpty())
            <div class="mt-4 d-flex justify-content-center">
                {{ $commandes->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .table th {
            white-space: nowrap;
        }
        .badge {
            font-size: 0.85em;
            padding: 0.35em 0.65em;
        }
        .pagination {
            margin-top: 20px;
            justify-content: center;
        }
        .pagination .page-link {
            color: #007bff;
            border-radius: 5px;
            margin: 0 3px;
            transition: all 0.3s ease;
        }
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
        }
        .pagination .page-link:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
