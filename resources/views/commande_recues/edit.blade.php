@extends('layout.mainlayout')

@section('content')
<div class="container py-4" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">Modifier la Commande Reçue</h2>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('commande-recues.update', $commandeRecue->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="idFournisseur" class="form-label">Fournisseur:</label>
                            <select class="form-select" id="idFournisseur" name="idFournisseur" required>
                                @foreach ($fournisseurs as $fournisseur)
                                    <option value="{{ $fournisseur->id }}" {{ $commandeRecue->idFournisseur == $fournisseur->id ? 'selected' : '' }}>
                                        {{ $fournisseur->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantite" class="form-label">Quantité:</label>
                            <input type="number" class="form-control" id="quantite" name="quantite" 
                                   value="{{ $commandeRecue->quantite }}" required min="1">
                        </div>

                        <div class="mb-3">
                            <label for="prix" class="form-label">Prix:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="prix" name="prix" 
                                       value="{{ number_format($commandeRecue->prix, 2) }}" required>
                                <span class="input-group-text">DH</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="idAchat" class="form-label">Achat:</label>
                            <select class="form-select" id="idAchat" name="idAchat" required>
                                @foreach ($achats as $achat)
                                    <option value="{{ $achat->id }}" {{ $commandeRecue->idAchat == $achat->id ? 'selected' : '' }}>
                                        {{ $achat->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="dateCommande" class="form-label">Date:</label>
                            <input type="date" class="form-control" id="dateCommande" name="dateCommande" 
                                   value="{{ date('Y-m-d', strtotime($commandeRecue->dateCommande)) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="statut" class="form-label">Statut:</label>
                            <select class="form-select" id="statut" name="statut" required>
                                <option value="en_attente" {{ $commandeRecue->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="en_cours" {{ $commandeRecue->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="livrée" {{ $commandeRecue->statut == 'livrée' ? 'selected' : '' }}>Livrée</option>
                                <option value="annulée" {{ $commandeRecue->statut == 'annulée' ? 'selected' : '' }}>Annulée</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('commande-recues.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Mettre à jour
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
    .form-control, .form-select {
        padding: 0.5rem 0.75rem;
    }
    .input-group-text {
        background-color: #f8f9fa;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Format price input
    document.getElementById('prix').addEventListener('blur', function() {
        let value = parseFloat(this.value.replace(',', '.'));
        if (!isNaN(value)) {
            this.value = value.toFixed(2);
        }
    });
</script>
@endpush