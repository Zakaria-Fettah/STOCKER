@extends('layout.mainlayout')

@section('content')
<div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h4 mb-0"><i class="fas fa-user-plus me-2"></i>Ajouter un Fournisseur</h1>
                        <a href="{{ route('fournisseurs.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Retour
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong><i class="fas fa-exclamation-circle me-1"></i> Erreurs de validation</strong>
                            <ul class="mt-2 mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('fournisseurs.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="row g-3">

                            <!-- Produits en Checkbox -->
                            <div class="col-12">
                                <label class="form-label"><i class="fas fa-box me-2"></i> Produits disponibles <span class="text-danger">*</span></label>
                                <div class="border rounded p-3">
                                    @foreach($produits as $produit)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="produits[]" id="produit_{{ $produit->id }}" value="{{ $produit->id }}"
                                                {{ in_array($produit->id, old('produits', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="produit_{{ $produit->id }}">
                                                {{ $produit->nom }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @if($errors->has('produits'))
                                    <div class="text-danger mt-1">{{ $errors->first('produits') }}</div>
                                @endif
                            </div>

                            <!-- Nom -->
                            <div class="col-md-6">
                                <label for="nom" class="form-label"><i class="fas fa-user me-2"></i> Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                                <div class="invalid-feedback">Veuillez entrer un nom.</div>
                            </div>

                            <!-- Prénom -->
                            <div class="col-md-6">
                                <label for="prenom" class="form-label"><i class="fas fa-user me-2"></i> Prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                                <div class="invalid-feedback">Veuillez entrer un prénom.</div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i> Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                <div class="invalid-feedback">Veuillez entrer un email valide.</div>
                            </div>

                            <!-- Téléphone -->
                            <div class="col-md-6">
                                <label for="telephone" class="form-label"><i class="fas fa-phone me-2"></i> Téléphone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                                <div class="invalid-feedback">Veuillez entrer un numéro de téléphone.</div>
                            </div>

                            <!-- Genre -->
                            <div class="col-md-6">
                                <label for="genre" class="form-label"><i class="fas fa-venus-mars me-2"></i> Genre <span class="text-danger">*</span></label>
                                <select class="form-select" id="genre" name="genre" required>
                                    <option value="" selected disabled>Sélectionnez un genre...</option>
                                    <option value="masculin" {{ old('genre') == 'masculin' ? 'selected' : '' }}>Masculin</option>
                                    <option value="feminin" {{ old('genre') == 'feminin' ? 'selected' : '' }}>Féminin</option>
                                </select>
                                <div class="invalid-feedback">Veuillez sélectionner un genre.</div>
                            </div>

                            <!-- Adresse -->
                            <div class="col-12">
                                <label for="adresse" class="form-label"><i class="fas fa-map-marker-alt me-2"></i> Adresse <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="adresse" name="adresse" rows="5" maxlength="1000" required>{{ old('adresse') }}</textarea>
                                <div class="invalid-feedback">Veuillez entrer une adresse.</div>
                            </div>

                            <!-- Condition de Paiement -->
                            <div class="col-md-6">
                                <label for="condition_payement" class="form-label"><i class="fas fa-money-bill me-2"></i> Condition de Paiement <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="condition_payement" name="condition_payement" value="{{ old('condition_payement') }}" required>
                                <div class="invalid-feedback">Veuillez entrer une condition de paiement.</div>
                            </div>

                            <!-- Date de Livraison -->
                            <div class="col-md-6">
                                <label for="date_livraison" class="form-label"><i class="fas fa-calendar-alt me-2"></i> Date de Livraison <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_livraison" name="date_livraison" value="{{ old('date_livraison') }}" required>
                                <div class="invalid-feedback">Veuillez sélectionner une date de livraison.</div>
                            </div>

                            <!-- Fiabilité -->
                            <div class="col-12">
                                <label for="fiabilite" class="form-label"><i class="fas fa-star me-2"></i> Fiabilité <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fiabilite" name="fiabilite" value="{{ old('fiabilite') }}" required>
                                <div class="invalid-feedback">Veuillez entrer une note de fiabilité.</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-1"></i> Réinitialiser
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Enregistrer
                            </button>
                        </div>
                    </form>
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
    .form-control, .form-select {
        padding: 0.5rem 0.75rem;
    }
    .invalid-feedback {
        display: none;
        font-size: 0.875em;
    }
    .was-validated .form-control:invalid ~ .invalid-feedback,
    .was-validated .form-select:invalid ~ .invalid-feedback {
        display: block;
    }
    .form-control::placeholder {
        color: #6c757d;
        opacity: 0.5;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (function() {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endpush
