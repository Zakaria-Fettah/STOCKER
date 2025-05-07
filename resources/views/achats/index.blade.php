@extends('layout.mainlayout')

@section('content')
<div class="container py-5" style="margin-top:50px; margin-left: 20%; max-width: 1030px;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Liste des Achats</h3>
                    <a href="{{ route('achats.create') }}" class="btn btn-light">Ajouter un Achat</a>
                </div>
                <div class="card-body">
            <!-- Search Form -->
<form method="GET" action="{{ route('achats.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Rechercher par produit ou fournisseur" value="{{ old('search', $search ?? '') }}">
        <button type="submit" class="btn btn-primary rounded" title="Rechercher">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>


                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- No Results -->
                    @if ($achats->isEmpty())
                        <div class="alert alert-info" role="alert">
                            Aucun achat trouvé.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Produit</th>
                                        <th>Fournisseur</th>
                                        <th>Prix d'Achat</th>
                                        <th>Quantité</th>
                                        <th>Date d'Achat</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($achats as $achat)
                                        <tr>
                                            <td>{{ $achat->produit->nom ?? 'Produit non trouvé' }}</td>
                                            <td>{{ $achat->fournisseur->nom ?? 'Fournisseur non trouvé' }}</td>
                                            <td>{{ number_format($achat->prix_achat, 2) }}DH</td>
                                            <td>{{ $achat->quantite_achat }}</td>
                                            <td>{{ \Carbon\Carbon::parse($achat->date_achat)->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('achats.show', $achat->id) }}"
                                                       class="btn btn-info btn-sm me-2"
                                                       title="Voir les détails">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('achats.edit', $achat->id) }}"
                                                       class="btn btn-warning btn-sm me-2"
                                                       title="Modifier l'achat">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <form action="{{ route('achats.destroy', $achat->id) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Voulez-vous vraiment supprimer cet achat ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-danger btn-sm"
                                                                title="Supprimer l'achat">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $achats->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
