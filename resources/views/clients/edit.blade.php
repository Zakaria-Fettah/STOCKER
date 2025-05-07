@extends('layout.mainlayout')

@section('content')
<div class="container " style="margin-left: 22%; max-width: 1030px; margin-top: 100px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="h4 mb-0">Modifier un Client</h1>
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

            <form action="{{ route('clients.update', $client->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- Produit --}}
                    <div class="col-md-6 mb-3">
                        <label for="idProduit" class="form-label">Produit</label>
                        <select name="idProduit" id="idProduit" class="form-select" required>
                            <option value="">-- Choisir un produit --</option>
                            @foreach($produits as $produit)
                                <option value="{{ $produit->id }}" {{ $client->idProduit == $produit->id ? 'selected' : '' }}>
                                    {{ $produit->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Type de client --}}
                    <div class="col-md-6 mb-3">
                        <label for="type_client" class="form-label">Type de Client</label>
                        <select name="type_client" id="type_client" class="form-select" required>
                            <option value="particulier" {{ $client->type_client === 'particulier' ? 'selected' : '' }}>Particulier</option>
                            <option value="entreprise" {{ $client->type_client === 'entreprise' ? 'selected' : '' }}>Entreprise</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    {{-- Nom --}}
                    <div class="col-md-6 mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $client->nom) }}" required>
                    </div>

                    {{-- Prénom --}}
                    <div class="col-md-6 mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom', $client->prenom) }}" required>
                    </div>
                </div>

                <div class="row">
                    {{-- Email --}}
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $client->email) }}" required>
                    </div>

                    {{-- Téléphone --}}
                    <div class="col-md-6 mb-3">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone', $client->telephone) }}" required>
                    </div>
                </div>

                {{-- Adresse --}}
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <textarea name="adresse" id="adresse" class="form-control" rows="4" required>{{ old('adresse', $client->adresse) }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('clients.index') }}" class="btn btn-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection