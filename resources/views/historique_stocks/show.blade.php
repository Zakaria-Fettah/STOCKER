@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Détails de l'historique #{{ $historiqueStock->id }}</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Client :</strong> {{ $historiqueStock->client->nom ?? 'N/A' }}</p>
            <p><strong>Fournisseur :</strong> {{ $historiqueStock->fournisseur->nom ?? 'N/A' }}</p>
            <p><strong>Produit :</strong> {{ $historiqueStock->produit->libelle ?? 'N/A' }}</p>
            <p><strong>Catégorie :</strong> {{ $historiqueStock->categorie->libelle ?? 'N/A' }}</p>
            <p><strong>Commande :</strong> #{{ $historiqueStock->commande->id ?? 'N/A' }}</p>
            <p><strong>Livraison :</strong> #{{ $historiqueStock->livraison->id ?? 'N/A' }}</p>
            <p><strong>Achat :</strong> #{{ $historiqueStock->achat->id ?? 'N/A' }}</p>
            <p><strong>Stock :</strong> Emplacement {{ $historiqueStock->stock->emplacement ?? 'N/A' }}</p>
            <p><strong>Bénéfice :</strong> {{ $historiqueStock->benifice }} DH</p>
            <p><strong>Date d'ajout :</strong> {{ $historiqueStock->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('historique-stocks.index') }}" class="btn btn-secondary mt-3">Retour</a>
    <a href="{{ route('historique-stocks.edit', $historiqueStock->id) }}" class="btn btn-primary mt-3">Modifier</a>
</div>
@endsection
