@extends('layout.mainlayout')

@section('content')
<div class="container" style="max-width: 1030px; margin-left: 20%; margin-top:100px;">
    <!-- Formulaire de recherche -->
    <form method="GET" action="{{ route('stocks.index') }}" class="input-group mb-4" style="max-width: 400px;">
        <input type="text" name="search" class="form-control" placeholder="Rechercher un produit ou une catégorie..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </form>

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h1 class="h3 fw-bold text-dark mb-0">Liste des Stocks</h1>
        <a href="{{ route('stocks.create') }}" class="btn btn-primary btn-lg shadow-sm">
            <i class="fas fa-plus me-2"></i> Ajouter un Stock
        </a>
    </div>

    <!-- Table Card -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-borderless align-middle mb-0">
                    <thead class="bg-light text-dark text-uppercase small">
                        <tr>
                          
                            <th scope="col" class="py-3">Produit</th>
                            <th scope="col" class="py-3">Catégorie</th>
                            <th scope="col" class="py-3">Quantité</th>
                            <th scope="col" class="py-3">Description</th> <!-- Added Description column -->
                            <th scope="col" class="py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stocks as $stock)
                        <tr>
                           
                            <td>{{ $stock->produit->nom ?? 'Produit non trouvé' }}</td>
                            <td>{{ $stock->categorie->nomCategorie ?? 'Catégorie non trouvée' }}</td>
                            <td>{{ $stock->quantite }}</td>
                            <td>{{ $stock->description ?? 'Aucune description' }}</td> <!-- Display Description -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('stocks.show', $stock->id) }}" 
                                       class="btn btn-sm btn-outline-info rounded-pill px-3" 
                                       title="Voir" 
                                       aria-label="Voir le stock">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('stocks.edit', $stock->id) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3" 
                                       title="Modifier" 
                                       aria-label="Modifier le stock">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('stocks.destroy', $stock->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3" 
                                                title="Supprimer" 
                                                aria-label="Supprimer le stock"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stock ?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted"> <!-- Updated colspan to 6 -->
                                <i class="fas fa-box-open fa-2x mb-2"></i><br>
                                Aucun stock disponible.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end mt-4">
        {{ $stocks->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@section('scripts')
<!-- Add page-specific scripts here if needed -->
@endsection
