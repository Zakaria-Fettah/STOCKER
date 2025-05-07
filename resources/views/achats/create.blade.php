@extends('layout.mainlayout')

@section('content')
<div class="container py-5" style="margin-top:50px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Ajouter un Achat</h2>
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

                    <form action="{{ route('achats.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="categorie_id" class="form-label fw-bold">Catégorie</label>
                            <select name="categorie_id" id="categorie_id" class="form-select" required>
                                <option value="">-- Sélectionner une catégorie --</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->nomCategorie }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
    <label for="idProduit" class="form-label fw-bold">Produit</label>
    <select name="idProduit" id="idProduit" class="form-select @error('idProduit') is-invalid @enderror" required>
        <option value="">-- Sélectionner un produit --</option>
        @foreach($produits as $produit)
            <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
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
                                    <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                                @endforeach
                            </select>
                            @error('idFournisseur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prix_achat" class="form-label fw-bold">Prix d'Achat</label>
                            <div class="input-group">
                                <span class="input-group-text">DH</span>
                                <input type="number" step="0.01" name="prix_achat" id="prix_achat" 
                                       class="form-control @error('prix_achat') is-invalid @enderror" 
                                       value="{{ old('prix_achat') }}" required>
                                @error('prix_achat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="quantite_achat" class="form-label fw-bold">Quantité</label>
                            <input type="number" name="quantite_achat" id="quantite_achat" 
                                   class="form-control @error('quantite_achat') is-invalid @enderror" 
                                   value="{{ old('quantite_achat') }}" required>
                            @error('quantite_achat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date_achat" class="form-label fw-bold">Date d'Achat</label>
                            <input type="date" name="date_achat" id="date_achat" 
                                   class="form-control @error('date_achat') is-invalid @enderror" 
                                   value="{{ old('date_achat', now()->format('Y-m-d')) }}" required>
                            @error('date_achat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('achats.index') }}" class="btn btn-secondary me-2">Annuler</a>
                            <button type="submit" class="btn btn-primary px-4">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const categorieSelect = document.getElementById("categorie_id");
    const produitSelect = document.getElementById("idProduit");

    categorieSelect.addEventListener("change", function () {
        const categorieId = this.value;
        produitSelect.innerHTML = '<option value="">-- Chargement... --</option>';

        if (!categorieId) {
            produitSelect.innerHTML = '<option value="">-- Sélectionner un produit --</option>';
            return;
        }

        fetch(`/categories/${categorieId}/produits`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Erreur réseau');
            return response.json();
        })
        .then(data => {
            produitSelect.innerHTML = '<option value="">-- Sélectionner un produit --</option>';
            if (data.length === 0) {
                produitSelect.innerHTML += '<option value="">Aucun produit disponible</option>';
            } else {
                data.forEach(prod => {
                    produitSelect.innerHTML += `<option value="${prod.id}">${prod.nom}</option>`;
                });
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            produitSelect.innerHTML = '<option value="">Erreur lors du chargement</option>';
        });
    });
});
</script>
@endpush


@endsection
