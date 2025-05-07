@extends('layout.mainlayout')

@section('content')
    <div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 text-primary"><i class="fas fa-users me-2"></i>Liste des Fournisseurs</h1>
            <a href="{{ route('fournisseurs.create') }}" class="btn btn-primary btn-lg" title="Ajouter un fournisseur">
                <i class="fas fa-user-plus me-2"></i>Ajouter un Fournisseur
            </a>
        </div>

        <!-- Formulaire de recherche -->
        <form method="GET" action="{{ route('fournisseurs.index') }}" class="input-group mb-4">
            <input type="text" name="search" class="form-control" placeholder="Rechercher un fournisseur..." value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-primary" title="Rechercher">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <div class="card shadow-lg">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Produits</th>
                                <th scope="col">Email</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($fournisseurs as $fournisseur)
                                <tr>
                                    <td>{{ $fournisseur->nom }} {{ $fournisseur->prenom }}</td>
                                    <td>
                                        @forelse($fournisseur->produits as $produit)
                                            <span class="badge bg-secondary">{{ $produit->nom }}</span>
                                        @empty
                                            <span class="badge bg-warning">Aucun produit</span>
                                        @endforelse
                                    </td>
                                    <td>{{ $fournisseur->email }}</td>
                                    <td>{{ $fournisseur->telephone }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('fournisseurs.show', $fournisseur->id) }}" class="btn btn-info btn-sm me-2" title="Voir">
                                                <i class="fas fa-eye"></i> 
                                            </a>
                                            <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}" class="btn btn-warning btn-sm me-2" title="Modifier">
                                                <i class="fas fa-pencil-alt"></i> 
                                            </a>
                                            <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce fournisseur ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                                                    <i class="fas fa-trash"></i> 
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Aucun fournisseur trouvé.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $fournisseurs->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    .card {
        border: none;
        border-radius: 10px;
    }
    .table {
        margin-bottom: 0;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .btn-group .btn {
        margin-right: 5px; /* Espace entre les boutons */
        border-radius: 10px; /* Ajout du border-radius pour tous les boutons */
    }
    .table-dark {
        background-color: #343a40;
        color: #fff;
    }

    /* Responsiveness - Ensure buttons and table are displayed well on smaller screens */
    @media (max-width: 768px) {
        .table th, .table td {
            font-size: 12px;
        }

        .btn-group .btn {
            margin-bottom: 5px;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
