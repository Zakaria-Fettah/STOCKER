@extends('layout.mainlayout')

@section('content')
<div class="container py-4" style="margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h4 mb-0">
                            <i class="fas fa-info-circle me-2"></i>Détail de la Catégorie
                        </h1>
                        <a href="{{ route('categories.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Retour
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="fw-bold text-primary">
                                    <i class="fas fa-tag me-2"></i>Nom de la catégorie
                                </h5>
                                <p class="fs-5">{{ $category->nomCategorie }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="fw-bold text-primary">
                                    <i class="fas fa-hashtag me-2"></i>Nombre de produits
                                </h5>
                                <p class="fs-5">{{ $category->products_count ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="fw-bold text-primary">
                                    <i class="fas fa-calendar-plus me-2"></i>Créée le
                                </h5>
                                <p class="fs-5">{{ $category->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="fw-bold text-primary">
                                    <i class="fas fa-calendar-alt me-2"></i>Modifiée le
                                </h5>
                                <p class="fs-5">{{ $category->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i> Modifier
                        </a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')">
                                <i class="fas fa-trash me-1"></i> Supprimer
                            </button>
                        </form>
                    </div>
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
    .text-primary {
        color: #0d6efd !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush