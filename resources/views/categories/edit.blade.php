@extends('layout.mainlayout')

@section('content')
<div class="container py-5" style="margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h4 mb-0">
                            <i class="fas fa-edit me-2"></i>Modifier la Catégorie
                        </h1>
                        <a href="{{ route('categories.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Retour
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong><i class="fas fa-exclamation-circle me-1"></i> Erreur de saisie</strong>
                        <ul class="mt-2 mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nomCategorie" class="form-label fw-bold">
                                <i class="fas fa-tag me-2"></i>Nom de la catégorie <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg" 
                                   id="nomCategorie" 
                                   name="nomCategorie" 
                                   value="{{ old('nomCategorie', $category->nomCategorie) }}" 
                                   required>
                            <div class="invalid-feedback">
                                Veuillez saisir un nom de catégorie valide.
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-2"></i>Réinitialiser
                            </button>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Mettre à jour
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