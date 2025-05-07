@extends('layout.mainlayout')

@section('content')
<div class="container-fluid py-4" style="margin-left: 20%; max-width: 1030px; margin-top: 60px;">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h4 mb-0"><i class="fas fa-info-circle me-2"></i>Détails du produit</h2>
                        <a class="btn btn-light btn-sm" href="{{ route('products.index') }}">
                            <i class="fas fa-arrow-left me-1"></i> Retour
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <!-- Product Image Column (placeholder) -->
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <div class="bg-light p-4 rounded" style="height: 100%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-cube fa-5x text-muted"></i>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i> Modifier
                                </a>
                            </div>
                        </div>
                        
                        <!-- Product Details Column -->
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th class="text-nowrap" style="width: 30%">
                                                <i class="fas fa-tag me-2 text-primary"></i>Nom
                                            </th>
                                            <td>{{ $product->nom }}</td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <i class="fas fa-align-left me-2 text-primary"></i>Description
                                            </th>
                                            <td>{{ $product->description ?? 'Non renseignée' }}</td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <i class="fas fa-euro-sign me-2 text-primary"></i>Prix
                                            </th>
                                            <td>{{ number_format($product->prix, 2) }} DH</td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <i class="fas fa-boxes me-2 text-primary"></i>Quantité
                                            </th>
                                            <td>
                                                <span class="badge bg-{{ $product->quantite > 10 ? 'success' : ($product->quantite > 0 ? 'warning text-dark' : 'danger') }}">
                                                    {{ $product->quantite }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <i class="fas fa-tags me-2 text-primary"></i>Catégorie
                                            </th>
                                            <td>
                                                <span class="badge bg-info text-dark">
                                                    {{ $product->category->nomCategorie ?? 'Non attribuée' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <i class="fas fa-calendar-alt me-2 text-primary"></i>Créé le
                                            </th>
                                            <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <i class="fas fa-sync-alt me-2 text-primary"></i>Mis à jour le
                                            </th>
                                            <td>{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between">
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?')">
                                <i class="fas fa-trash me-1"></i> Supprimer
                            </button>
                        </form>
                        <div>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning me-2">
                                <i class="fas fa-edit me-1"></i> Modifier
                            </a>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-list me-1"></i> Liste des produits
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    .card-header {
        border-bottom: none;
    }
    .table th {
        font-weight: 600;
        color: #495057;
    }
    .badge {
        font-size: 0.9em;
        padding: 0.5em 0.75em;
    }
    .table-borderless tbody tr td {
        padding: 0.75rem 0.5rem;
    }
    .table-borderless tbody tr th {
        padding: 0.75rem 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush