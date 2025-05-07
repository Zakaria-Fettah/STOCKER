@extends('layout.mainlayout')

@section('content')
<div class="container" style="margin-left: 20%; max-width: 1000px; margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success mt-2">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger mt-2">{{ session('error') }}</div>
            @endif
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Modifier la Livraison</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('livraisons.update', $livraison->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $livraison->date }}" required>
                            @error('date')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select class="form-select" id="statut" name="statut" required>
                                <option value="préparée" {{ $livraison->statut == 'préparée' ? 'selected' : '' }}>Préparée</option>
                                <option value="en_cours" {{ $livraison->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="livrée" {{ $livraison->statut == 'livrée' ? 'selected' : '' }}>Livrée</option>
                                <option value="retardée" {{ $livraison->statut == 'retardée' ? 'selected' : '' }}>Retardée</option>
                                <option value="annulée" {{ $livraison->statut == 'annulée' ? 'selected' : '' }}>Annulée</option>
                            </select>
                            @error('statut')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="quantite" class="form-label">Quantité</label>
                            <input type="number" class="form-control" id="quantite" name="quantite" value="{{ $livraison->quantite }}" required>
                            @error('quantite')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type de livraison</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ $livraison->type }}" required>
                            @error('type')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idClient" class="form-label">Client</label>
                            <select class="form-select" id="idClient" name="idClient" required>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ $livraison->idClient == $client->id ? 'selected' : '' }}>{{ $client->nom }}</option>
                                @endforeach
                            </select>
                            @error('idClient')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idCommande" class="form-label">Commande envoyée</label>
                            <select class="form-select" id="idCommande" name="idCommande" required>
                                @foreach ($commandes as $commande)
                                    <option value="{{ $commande->id }}" {{ $livraison->idCommande == $commande->id ? 'selected' : '' }}>{{ $commande->id }}</option>
                                @endforeach
                            </select>
                            @error('idCommande')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idCategorie" class="form-label">Catégorie</label>
                            <select class="form-select" id="idCategorie" name="idCategorie" required>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ $livraison->idCategorie == $categorie->id ? 'selected' : '' }}>{{ $categorie->nomCategorie }}</option>
                                @endforeach
                            </select>
                            @error('idCategorie')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idProduit" class="form-label">Produit</label>
                            <select class="form-select" id="idProduit" name="idProduit" required>
                                @foreach ($produits as $produit)
                                    <option value="{{ $produit->id }}" {{ $livraison->idProduit == $produit->id ? 'selected' : '' }}>{{ $produit->nom }}</option>
                                @endforeach
                            </select>
                            @error('idProduit')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-custom">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
