@extends('layout.mainlayout')

@section('content')
<div class="container" style="margin-left: 20%; max-width: 1000px; margin-top: 80px;">
    <h2>Détails de la Livraison</h2>

    <div class="card">
        <div class="card-header">
            Livraison #{{ $livraison->id }}
        </div>
        <div class="card-body">
            <p><strong>Date:</strong> {{ $livraison->date }}</p>
            <p><strong>Statut:</strong> {{ ucfirst($livraison->statut) }}</p>
            <p><strong>Quantité:</strong> {{ $livraison->quantite }}</p>
            <p><strong>Type de Livraison:</strong> {{ $livraison->type }}</p>
            <p><strong>Client:</strong> {{ $livraison->client->nom }}</p>
            <p><strong>Commande ID:</strong> {{ $livraison->commande->id }}</p>
            <p><strong>Catégorie:</strong> {{ $livraison->categorie->libelle }}</p>
            <p><strong>Produit:</strong> {{ $livraison->produit->nom }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('livraisons.index') }}" class="btn btn-secondary">Retour à la liste des livraisons</a>
            <a href="{{ route('livraisons.edit', $livraison->id) }}" class="btn btn-warning">Modifier</a>
        </div>
    </div>
</div>
@endsection
