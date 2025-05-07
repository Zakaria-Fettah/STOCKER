@extends('layout.mainlayout')

@section('content')
<div class="container py-5" style="margin-left: 20%; max-width: 1030px; margin-top: 60px;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Ajouter une Catégorie
                    </h1>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-4">
                            <label for="nomCategorie" class="form-label fw-bold">
                                <i class="fas fa-tag me-2"></i>Nom de la catégorie <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('nomCategorie') is-invalid @enderror" 
                                   id="nomCategorie" 
                                   name="nomCategorie" 
                                   placeholder="Ex : Électronique, Vêtements, etc." 
                                   required
                                   value="{{ old('nomCategorie') }}">
                            @error('nomCategorie')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Enregistrer
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
    .form-control-lg {
        padding: 0.75rem 1rem;
        font-size: 1.1rem;
    }
    .invalid-feedback {
        display: none;
        font-size: 0.875em;
    }
    .was-validated .form-control:invalid ~ .invalid-feedback {
        display: block;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Validation du formulaire
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
