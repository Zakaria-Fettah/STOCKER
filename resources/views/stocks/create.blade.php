@extends('layout.mainlayout')

@section('content')
<div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h4 mb-0"><i class="fas fa-boxes me-2"></i>Ajouter un stock</h1>
                        <a href="{{ route('stocks.index') }}" class="btn btn-light btn-sm">
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

                    <form action="{{ route('stocks.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="row g-3">
                            <!-- Produit Field -->
                            <div class="col-md-6">
                                <label for="idProduit" class="form-label">
                                    <i class="fas fa-box me-2"></i> Produit <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="idProduit" name="idProduit" required>
                                    <option value="" selected disabled>Sélectionnez un produit...</option>
                                    @foreach($produits as $produit)
                                    <option value="{{ $produit->id }}" {{ old('idProduit') == $produit->id ? 'selected' : '' }}>
                                        {{ $produit->nom }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner un produit.
                                </div>
                            </div>

                            <!-- Catégorie Field -->
                            <div class="col-md-6">
                                <label for="idCategorie" class="form-label">
                                    <i class="fas fa-tag me-2"></i> Catégorie <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="idCategorie" name="idCategorie" required>
                                    <option value="" selected disabled>Sélectionnez une catégorie...</option>
                                    @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ old('idCategorie') == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->nomCategorie }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner une catégorie.
                                </div>
                            </div>

                            <!-- Quantité Field -->
                            <div class="col-md-6">
                                <label for="quantite" class="form-label">
                                    <i class="fas fa-cubes me-2"></i> Quantité <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control" id="quantite" name="quantite" 
                                       value="{{ old('quantite') }}" required min="0" placeholder="0">
                                <div class="invalid-feedback">
                                    Veuillez saisir une quantité valide (minimum 0).
                                </div>
                            </div>

                            <!-- Description Field -->
                            <div class="col-md-12">
                                <label for="description" class="form-label">
                                    <i class="fas fa-info-circle me-2"></i> Description
                                </label>
                                <textarea class="form-control" id="description" name="description" rows="5" maxlength="1000" placeholder="Entrez une description (facultatif)">{{ old('description') }}</textarea>
                                <div class="invalid-feedback">
                                    La description ne peut pas dépasser 1000 caractères.
                                </div>
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
    // Form validation
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