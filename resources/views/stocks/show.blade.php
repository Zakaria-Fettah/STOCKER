@extends('layout.mainlayout')

@section('content')
<div class="container" style="max-width: 1030px; margin-top:100px;margin-left: 20%;">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4><i class="fas fa-boxes me-2"></i> Détails du Stock #{{ $stock->id }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Produit :</strong> {{ $stock->produit->nom ?? 'Produit non trouvé' }}</p>
            <p><strong>Catégorie :</strong> {{ $stock->categorie->nomCategorie ?? 'Catégorie non trouvée' }}</p>
            <p><strong>Quantité :</strong> {{ $stock->quantite }}</p>
            <p><strong>Description :</strong> {{ $stock->description ?? 'Aucune description' }}</p> <!-- Added Description -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('stocks.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Retour
                </a>
                <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit me-1"></i> Modifier
                </a>
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
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush