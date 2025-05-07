@extends('layout.mainlayout')
@section('content')
<div class="container py-5" style="margin-top:50px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Modifier l'Achat #{{ $achat->id }}</h2>
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

                    <form action="{{ route('achats.update', $achat->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="idProduit" class="form-label fw-bold">Produit</label>
                            <select name="idProduit" id="idProduit" class="form-select @error('idProduit') is-invalid @enderror" required>
                                <option value="">-- Sélectionner un produit --</option>
                                @foreach ($produits as $produit)
                                    <option value="{{ $produit->id }}" {{ $produit->id == $achat->idProduit ? 'selected' : '' }}>
                                        {{ $produit->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idProduit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idFournisseur" class="form-label fw-bold">Fournisseur</label>
                            <select name="idFournisseur" id="idFournisseur" class="form-select @error('idFournisseur') is-invalid @enderror" required>
                                <option value="">-- Sélectionner un fournisseur --</option>
                                @foreach ($fournisseurs as $fournisseur)
                                    <option value="{{ $fournisseur->id }}" {{ $fournisseur->id == $achat->idFournisseur ? 'selected' : '' }}>
                                        {{ $fournisseur->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idFournisseur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prix_achat" class="form-label fw-bold">Prix d'Achat</label>
                            <div class="input-group">
                                <span class="input-group-text">MAD</span>
                                <input type="number" step="0.01" name="prix_achat" id="prix_achat" 
                                       class="form-control @error('prix_achat') is-invalid @enderror" 
                                       value="{{ old('prix_achat', $achat->prix_achat) }}" required>
                                @error('prix_achat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="quantite_achat" class="form-label fw-bold">Quantité</label>
                            <input type="number" name="quantite_achat" id="quantite_achat" 
                                   class="form-control @error('quantite_achat') is-invalid @enderror" 
                                   value="{{ old('quantite_achat', $achat->quantite_achat) }}" required>
                            @error('quantite_achat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date_achat" class="form-label fw-bold">Date d'Achat</label>
                            <input type="date" name="date_achat" id="date_achat" 
                                   class="form-control @error('date_achat') is-invalid @enderror" 
                                   value="{{ old('date_achat', \Carbon\Carbon::parse($achat->date_achat)->format('Y-m-d')) }}" required>
                            @error('date_achat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('achats.show', $achat->id) }}" class="btn btn-secondary me-2">Annuler</a>
                            <button type="submit" class="btn btn-primary px-4">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection