<div class="mb-3">
    <label for="idClient" class="form-label">Client</label>
    <select name="idClient" class="form-control">
        @foreach($clients as $client)
            <option value="{{ $client->id }}" {{ (old('idClient', $historiqueStock->idClient ?? '') == $client->id) ? 'selected' : '' }}>
                {{ $client->nom }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="idFournisseur" class="form-label">Fournisseur</label>
    <select name="idFournisseur" class="form-control">
        @foreach($fournisseurs as $fournisseur)
            <option value="{{ $fournisseur->id }}" {{ (old('idFournisseur', $historiqueStock->idFournisseur ?? '') == $fournisseur->id) ? 'selected' : '' }}>
                {{ $fournisseur->nom }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="idProduit" class="form-label">Produit</label>
    <select name="idProduit" class="form-control">
        @foreach($produits as $produit)
            <option value="{{ $produit->id }}" {{ (old('idProduit', $historiqueStock->idProduit ?? '') == $produit->id) ? 'selected' : '' }}>
                {{ $produit->libelle }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="idCategorie" class="form-label">Catégorie</label>
    <select name="idCategorie" class="form-control">
        @foreach($categories as $categorie)
            <option value="{{ $categorie->id }}" {{ (old('idCategorie', $historiqueStock->idCategorie ?? '') == $categorie->id) ? 'selected' : '' }}>
                {{ $categorie->libelle }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="idCommande" class="form-label">Commande</label>
    <select name="idCommande" class="form-control">
        @foreach($commandes as $commande)
            <option value="{{ $commande->id }}" {{ (old('idCommande', $historiqueStock->idCommande ?? '') == $commande->id) ? 'selected' : '' }}>
                #{{ $commande->id }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="idLivraison" class="form-label">Livraison</label>
    <select name="idLivraison" class="form-control">
        @foreach($livraisons as $livraison)
            <option value="{{ $livraison->id }}" {{ (old('idLivraison', $historiqueStock->idLivraison ?? '') == $livraison->id) ? 'selected' : '' }}>
                #{{ $livraison->id }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="idAchat" class="form-label">Achat</label>
    <select name="idAchat" class="form-control">
        @foreach($achats as $achat)
            <option value="{{ $achat->id }}" {{ (old('idAchat', $historiqueStock->idAchat ?? '') == $achat->id) ? 'selected' : '' }}>
                #{{ $achat->id }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="idStock" class="form-label">Stock</label>
    <select name="idStock" class="form-control">
        @foreach($stocks as $stock)
            <option value="{{ $stock->id }}" {{ (old('idStock', $historiqueStock->idStock ?? '') == $stock->id) ? 'selected' : '' }}>
                Emplacement: {{ $stock->emplacement }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="benifice" class="form-label">Bénéfice (DH)</label>
    <input type="number" step="0.01" name="benifice" class="form-control" value="{{ old('benifice', $historiqueStock->benifice ?? 0) }}">
</div>
