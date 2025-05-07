@extends('layout.mainlayout')
@section('content')
<div class="container py-5" style="margin-top:50px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Modifier la Vente</h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('ventes.update', $vente->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="idProduit" class="form-label fw-bold">Produit</label>
                            <select name="idProduit" class="form-select @error('idProduit') is-invalid @enderror" required>
                                <option value="">-- Sélectionner un produit --</option>
                                @foreach ($produits as $produit)
                                    <option value="{{ $produit->id }}" {{ $produit->id == $vente->idProduit ? 'selected' : '' }}>
                                        {{ $produit->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idProduit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idClient" class="form-label fw-bold">Client</label>
                            <select name="idClient" class="form-select @error('idClient') is-invalid @enderror" required>
                                <option value="">-- Sélectionner un client --</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ $client->id == $vente->idClient ? 'selected' : '' }}>
                                        {{ $client->name ?? $client->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idClient')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idStock" class="form-label fw-bold">Stock</label>
                            <select name="idStock" class="form-select @error('idStock') is-invalid @enderror" required>
                                <option value="">-- Sélectionner un stock --</option>
                                @foreach ($stocks as $stock)
                                    <option value="{{ $stock->id }}" {{ $stock->id == $vente->idStock ? 'selected' : '' }}>
                                        Stock #{{ $stock->id }} - {{ $stock->quantity ?? $stock->quantite }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idStock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="quantiteVendue" class="form-label fw-bold">Quantité vendue</label>
                            <input type="number" name="quantiteVendue" class="form-control @error('quantiteVendue') is-invalid @enderror" 
                                   value="{{ old('quantiteVendue', $vente->quantiteVendue) }}" required>
                            @error('quantiteVendue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prixUnitaire" class="form-label fw-bold">Prix unitaire</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" name="prixUnitaire" 
                                       class="form-control @error('prixUnitaire') is-invalid @enderror" 
                                       value="{{ old('prixUnitaire', $vente->prixUnitaire) }}" required>
                                @error('prixUnitaire')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('ventes.show', $vente->id) }}" class="btn btn-secondary me-2">Annuler</a>
                            <button type="submit" class="btn btn-primary px-4">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection