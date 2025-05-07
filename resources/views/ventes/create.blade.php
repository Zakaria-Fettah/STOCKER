@extends('layout.mainlayout')

@section('content')
<div class="container py-5" style="margin-top:50px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Ajouter une Vente</h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('ventes.store') }}" method="POST">
                        @csrf

                        <!-- Sélection du produit -->
                        <select id="idProduit" name="idProduit" class="form-control">
    <option value="">-- Choisir un produit --</option>
    @foreach($produits as $produit)
        <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
    @endforeach
</select>

<label>Prix d'achat du produit :</label>
<input type="text" id="prix_achat" class="form-control" readonly>


                        <!-- Sélection du client -->
                        <div class="mb-3">
                            <label for="idClient" class="form-label fw-bold">Client</label>
                            <select name="idClient" class="form-select" required>
                                <option value="">-- Sélectionner un client --</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sélection du stock -->
                        <div class="mb-3">
                            <label for="idStock" class="form-label fw-bold">Stock</label>
                            <select name="idStock" class="form-select" id="idStock" required>
                                <option value="">-- Sélectionner un stock --</option>
                                @foreach ($stocks as $stock)
                                    <option value="{{ $stock->id }}" data-quantite="{{ $stock->quantite }}">Stock #{{ $stock->id }} - {{ $stock->quantite }} disponible</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Quantité vendue -->
                        <div class="mb-3">
                            <label for="quantiteVendue" class="form-label fw-bold">Quantité vendue</label>
                            <input type="number" name="quantiteVendue" class="form-control" id="quantiteVendue" required>
                        </div>

                        <!-- Prix unitaire -->
                        <div class="mb-3">
                            <label for="prixUnitaire" class="form-label fw-bold">Prix unitaire</label>
                            <div class="input-group">
                                <span class="input-group-text">DH</span>
                                <input type="number" step="0.01" name="prixUnitaire" class="form-control" id="prixUnitaire" required>
                            </div>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success px-4">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#idProduit').change(function() {
        var produitId = $(this).val();
        if (produitId) {
            $.ajax({
                url: '/get-produit-price/' + produitId,
                type: 'GET',
                success: function(data) {
                    $('#prix_achat').val(data.prix); 
                }
            });
        } else {
            $('#prix_achat').val('');
        }
    });
});
</script>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        var quantiteVendue = parseInt(document.querySelector('[name="quantiteVendue"]').value);
        var stockQuantite = parseInt(document.querySelector('[name="idStock"] option:checked').dataset.quantite);
        var prixUnitaire = parseFloat(document.querySelector('[name="prixUnitaire"]').value);
        var prixAchat = parseFloat(document.querySelector('[name="idProduit"] option:checked').dataset.prixAchat);

        // Vérification de la quantité en stock
        if (quantiteVendue > stockQuantite) {
            event.preventDefault();
            alert("La quantité vendue dépasse le stock disponible.");
        }

        // Vérification du prix de vente par rapport au prix d'achat
        if (prixUnitaire < prixAchat) {
            event.preventDefault();
            alert("Le prix de vente ne peut pas être inférieur au prix d'achat.");
        }
    });
</script>
@endsection
