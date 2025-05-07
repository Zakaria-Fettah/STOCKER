@extends('layout.mainlayout')

@section('content')
<div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h4 mb-0">Détails du Fournisseur</h2>
                <a href="{{ route('fournisseurs.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Retour à la liste
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <h5 class="text-primary">Informations Personnelles</h5>
                        <hr class="mt-1 mb-3">
                        <p><strong>Nom complet:</strong> {{ $fournisseur->nom }} {{ $fournisseur->prenom }}</p>
                        <p><strong>Genre:</strong> 
                            <span class="badge bg-{{ $fournisseur->genre == 'M' ? 'primary' : 'success' }}">
                                {{ $fournisseur->genre == 'M' ? 'Masculin' : 'Féminin' }}
                            </span>
                        </p>
                        <p><strong>Email:</strong> <a href="mailto:{{ $fournisseur->email }}">{{ $fournisseur->email }}</a></p>
                        <p><strong>Téléphone:</strong> <a href="tel:{{ $fournisseur->telephone }}">{{ $fournisseur->telephone }}</a></p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <h5 class="text-primary">Informations Professionnelles</h5>
                        <hr class="mt-1 mb-3">
                        <p><strong>Condition de paiement:</strong> {{ $fournisseur->condition_payement }}</p>
                        <p><strong>Date de livraison:</strong> 
                            <span class="badge bg-secondary">{{ $fournisseur->date_livraison }}</span>
                        </p>
                        <p><strong>Fiabilité:</strong> 
                            @php
                                $fiabiliteClass = [
                                    'Haute' => 'bg-success',
                                    'Moyenne' => 'bg-warning text-dark',
                                    'Basse' => 'bg-danger'
                                ][$fournisseur->fiabilite] ?? 'bg-secondary';
                            @endphp
                            <span class="badge {{ $fiabiliteClass }}">{{ $fournisseur->fiabilite }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Produits fournis -->
            <div class="mt-4">
                <h5 class="text-primary">Produits fournis :</h5>
                <hr class="mt-1 mb-3">
                <ul>
                    @foreach($fournisseur->produits as $produit)
                        <li>{{ $produit->nom }}</li>
                    @endforeach
                </ul>
            </div>
            
            <div class="mt-4 d-flex justify-content-end">
                <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit me-1"></i> Modifier
                </a>
                <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fournisseur?')">
                        <i class="fas fa-trash-alt me-1"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 8px;
    }
    .card-header {
        border-radius: 8px 8px 0 0 !important;
    }
    hr {
        opacity: 0.2;
    }
    .badge {
        font-size: 0.85em;
        padding: 0.4em 0.7em;
    }
    p {
        margin-bottom: 0.8rem;
    }
</style>
@endsection

@section('scripts')
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Bootstrap JS bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
