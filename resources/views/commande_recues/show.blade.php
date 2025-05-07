@extends('layout.mainlayout')

@section('content')
<div class="container py-4" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">Détails de la Commande Reçue</h2>
                        <a href="{{ route('commande-recues.edit', $commandeRecue->id) }}" class="btn btn-sm btn-light">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Fournisseur:</div>
                        <div class="col-md-8">{{ $commandeRecue->fournisseur->nom ?? 'N/A' }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Quantité:</div>
                        <div class="col-md-8">{{ $commandeRecue->quantite }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Prix:</div>
                        <div class="col-md-8">{{ number_format($commandeRecue->prix, 2) }} DH</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Achat:</div>
                        <div class="col-md-8">{{ $commandeRecue->achat->id ?? 'N/A' }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Date:</div>
                        <div class="col-md-8">{{ date('d/m/Y', strtotime($commandeRecue->dateCommande)) }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Statut:</div>
                        <div class="col-md-8">
                            <span class="badge 
                                @if($commandeRecue->statut == 'livré') bg-success 
                                @elseif($commandeRecue->statut == 'en cours') bg-warning text-dark 
                                @elseif($commandeRecue->statut == 'annulé') bg-danger 
                                @else bg-secondary @endif">
                                {{ $commandeRecue->statut }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-light">
                    <a href="{{ route('commande-recues.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }
    .card-header {
        border-bottom: none;
    }
    .badge {
        font-size: 0.9em;
        padding: 0.5em 0.75em;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush