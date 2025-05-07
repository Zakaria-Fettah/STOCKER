@extends('layout.mainlayout')

@section('content')
<div class="container-fluid py-4" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h4 mb-0"><i class="fas fa-edit me-2"></i>Modifier le produit</h2>
                        <a class="btn btn-light btn-sm" href="{{ route('products.index') }}">
                            <i class="fas fa-arrow-left me-1"></i> Retour
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong><i class="fas fa-exclamation-circle me-1"></i> Erreur de saisie</strong>
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('products.update', $product->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Category Field -->
                            <div class="col-md-6">
                                <label for="idcategories" class="form-label">
                                    <i class="fas fa-tags me-1"></i> Catégorie <span class="text-danger">*</span>
                                </label>
                                <select name="idcategories" class="form-select" required>
                                    <option value="" disabled>Sélectionnez une catégorie...</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $product->idcategories == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->nomCategorie }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner une catégorie.
                                </div>
                            </div>

                            <!-- Name Field -->
                            <div class="col-md-6">
                                <label for="nom" class="form-label">
                                    <i class="fas fa-tag me-1"></i> Nom <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nom" class="form-control" 
                                       value="{{ old('nom', $product->nom) }}" required>
                                <div class="invalid-feedback">
                                    Veuillez saisir le nom du produit.
                                </div>
                            </div>

                            <!-- Description Field -->
                            <div class="col-12">
                                <label for="description" class="form-label">
                                    <i class="fas fa-align-left me-1"></i> Description
                                </label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <!-- Price Field -->
                            <div class="col-md-6">
                                <label for="prix" class="form-label">
                                    <i class="fas fa-euro-sign me-1"></i> Prix <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="prix" class="form-control" 
                                           value="{{ old('prix', $product->prix) }}" required min="0">
                                    <span class="input-group-text">DH</span>
                                </div>
                                <div class="invalid-feedback">
                                    Veuillez saisir un prix valide.
                                </div>
                            </div>

                            <!-- Quantity Field -->
                            <div class="col-md-6">
                                <label for="quantite" class="form-label">
                                    <i class="fas fa-boxes me-1"></i> Quantité <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="quantite" class="form-control" 
                                       value="{{ old('quantite', $product->quantite) }}" required min="0">
                                <div class="invalid-feedback">
                                    Veuillez saisir une quantité valide.
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4 gap-2">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-1"></i> Réinitialiser
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Mettre à jour
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
    .input-group-text {
        background-color: #f8f9fa;
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