@extends('layout.mainlayout')
@section('content')
<div class="container py-5" style="margin-top:50px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Détails de la Vente</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">ID Vente</h5>
                            <p>{{ $vente->id }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">Produit</h5>
                            <p>{{ $vente->produit->nom }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">Client</h5>
                            <p>{{ $vente->client->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">Stock Disponible</h5>
                            <p>{{ $vente->stock->quantity }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">Quantité Vendue</h5>
                            <p>{{ $vente->quantiteVendue }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">Prix Unitaire</h5>
                            <p>${{ number_format($vente->prixUnitaire, 2) }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">Total</h5>
                            <p>${{ number_format($vente->total, 2) }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">Bénéfice</h5>
                            <p>${{ number_format($vente->benifice, 2) }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">Date de Création</h5>
                            <p>{{ $vente->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">Date de Mise à Jour</h5>
                            <p>{{ $vente->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('ventes.index') }}" class="btn btn-secondary me-2">Retour à la liste</a>
                    <a href="{{ route('ventes.edit', $vente->id) }}" class="btn btn-primary">Modifier</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection