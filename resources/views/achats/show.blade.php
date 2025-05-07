@extends('layout.mainlayout')
@section('content')
<div class="container py-5" style="margin-top:50px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Détails de l'Achat #{{ $achat->id }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">Produit</h5>
                            <p>{{ $achat->produit->nom }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">Fournisseur</h5>
                            <p>{{ $achat->fournisseur->nom }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">Prix d'Achat</h5>
                            <p>{{ number_format($achat->prix_achat, 2) }} MAD</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">Quantité</h5>
                            <p>{{ $achat->quantite_achat }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="fw-bold">Date d'Achat</h5>
                            <p>{{ \Carbon\Carbon::parse($achat->date_achat)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('achats.index') }}" class="btn btn-secondary me-2">Retour à la liste</a>
                    <a href="{{ route('achats.edit', $achat->id) }}" class="btn btn-primary">Modifier</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection