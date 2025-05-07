@extends('layout.mainlayout')

@section('content')
    <div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h4 mb-0">Ajouter une nouvelle livraison</h1>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('livraisons.store') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="idCategorie" class="form-label">Catégorie</label>
                                    <select name="idCategorie" id="idCategorie" class="form-select" required>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->nomCategorie }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                         

                            <div class="mb-4">
                                <label for="idProduit" class="form-label">Produit</label>
                                <select name="idProduit" id="idProduit" class="form-select" required>
                                    @foreach ($produits as $produit)
                                        <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="quantite" class="form-label">Quantité</label>
                                    <input type="number" name="quantite" id="quantite" class="form-control" required>
                                </div>
                                <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="idClient" class="form-label">Client</label>
                                    <select name="idClient" id="idClient" class="form-select" required>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="type" class="form-label">Type de livraison</label>
                                    <input type="text" name="type" id="type" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <label for="idCommande" class="form-label">Commande envoyee</label>
                                    <select name="idCommande" id="idCommande" class="form-select" required>
                                        @foreach ($commandes as $commande)
                                            <option value="{{ $commande->id }}">{{ $commande->id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            <div class="col-md-6">
                                    <label for="statut" class="form-label">Statut</label>
                                    <select name="statut" id="statut" class="form-select" required>
                                        <option value="préparée">Préparée</option>
                                        <option value="en_cours">En cours</option>
                                        <option value="livrée">Livrée</option>
                                        <option value="retardée">Retardée</option>
                                        <option value="annulée">Annulée</option>
                                    </select>
                                </div>
                            </div>
                           
                                
                             
                      
                                
                             
                           


                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-success me-md-2">
                                    <i class="fas fa-plus-circle me-2"></i>Ajouter
                                </button>
                                <a href="{{ route('livraisons.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection