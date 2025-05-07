@extends('layout.mainlayout')

@section('content')
<div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h4 mb-0"><i class="fas fa-cart-plus me-2"></i>Ajouter une Commande Reçue</h2>
                        <a href="{{ route('commande-recues.index') }}" class="btn btn-sm btn-light">
                            <i class="fas fa-arrow-left me-1"></i> Retour
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('commande-recues.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="row g-3">
                            <!-- Fournisseur Field -->
                            <div class="col-md-6">
                                <label for="idFournisseur" class="form-label">
                                    <i class="fas fa-truck me-1"></i> Fournisseur <span class="text-danger">*</span>
                                </label>
                                <select class="form-select select2" id="idFournisseur" name="idFournisseur" required>
                                    <option value="" disabled selected>Choisir un fournisseur...</option>
                                    @foreach ($fournisseurs as $fournisseur)
                                        <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner un fournisseur.
                                </div>
                            </div>

                            <!-- Achat Field -->
                            <div class="col-md-6">
                                <label for="idAchat" class="form-label">
                                    <i class="fas fa-shopping-basket me-1"></i> Achat <span class="text-danger">*</span>
                                </label>
                                <select class="form-select select2" id="idAchat" name="idAchat" required>
                                    <option value="" disabled selected>Choisir un achat...</option>
                                    @foreach ($achats as $achat)
                                        <option value="{{ $achat->id }}"> {{ $achat->id }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner un achat.
                                </div>
                            </div>

                            <!-- Quantity Field -->
                            <div class="col-md-4">
                                <label for="quantite" class="form-label">
                                    <i class="fas fa-boxes me-1"></i> Quantité <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control" id="quantite" name="quantite" 
                                       min="1" required placeholder="1">
                                <div class="invalid-feedback">
                                    Veuillez entrer une quantité valide (minimum 1).
                                </div>
                            </div>

                            <!-- Price Field -->
                            <div class="col-md-4">
                                <label for="prix" class="form-label">
                                <i class="fas fa-money-bill-wave me-1"></i>  Prix <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="prix" name="prix" 
                                           step="0.01" min="0" required placeholder="0.00">
                                    <span class="input-group-text">DH</span>
                                </div>
                                <div class="invalid-feedback">
                                    Veuillez entrer un prix valide.
                                </div>
                            </div>

                            <!-- Date Field -->
                            <div class="col-md-4">
                                <label for="dateCommande" class="form-label">
                                    <i class="fas fa-calendar-alt me-1"></i> Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control" id="dateCommande" name="dateCommande" 
                                       required value="{{ date('Y-m-d') }}">
                                <div class="invalid-feedback">
                                    Veuillez sélectionner une date.
                                </div>
                            </div>

                            <!-- Status Field -->
                            <div class="col-md-12">
                                <label for="statut" class="form-label">
                                    <i class="fas fa-info-circle me-1"></i> Statut <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="statut" name="statut" required>
                                    <option value="en_attente">En attente</option>
                                    <option value="en_cours" selected>En cours</option>
                                    <option value="livrée">Livrée</option>
                                    <option value="annulée">Annulée</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-outline-secondary me-md-2">
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }
    .card-header {
        border-bottom: none;
    }
    .select2-container--default .select2-selection--single {
        height: 38px;
        padding: 5px;
        border: 1px solid #ced4da;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
    .form-control, .form-select, .select2-selection {
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
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // Initialize Select2
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: $(this).data('placeholder'),
            width: '100%'
        });
        
        // Set today's date as default
        document.getElementById('dateCommande').valueAsDate = new Date();
        
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
    });
</script>
@endpush