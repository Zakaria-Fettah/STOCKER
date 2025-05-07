@extends('layout.mainlayout')

@section('content')
<div class="container py-5" style="margin-top:50px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Ajouter un Client</h2>
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

                    <form action="{{ route('clients.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="idProduit" class="form-label fw-bold">Produit</label>
                            <select name="idProduit" id="idProduit" class="form-select @error('idProduit') is-invalid @enderror">
                                <option value="">-- Sélectionner un produit --</option>
                                @foreach ($produits as $produit)
                                    <option value="{{ $produit->id }}" {{ old('idProduit') == $produit->id ? 'selected' : '' }}>
                                        {{ $produit->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idProduit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nom" class="form-label fw-bold">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label fw-bold">Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom') }}" required>
                            @error('prenom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telephone" class="form-label fw-bold">Téléphone</label>
                            <input type="text" name="telephone" id="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone') }}" required>
                            @error('telephone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="adresse" class="form-label fw-bold">Adresse</label>
                            <textarea name="adresse" id="adresse" class="form-control @error('adresse') is-invalid @enderror" required>{{ old('adresse') }}</textarea>
                            @error('adresse')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type_client" class="form-label fw-bold">Type de Client</label>
                            <select name="type_client" id="type_client" class="form-select @error('type_client') is-invalid @enderror" required>
                                <option value="">-- Sélectionner un type --</option>
                                <option value="particulier" {{ old('type_client') == 'particulier' ? 'selected' : '' }}>Particulier</option>
                                <option value="entreprise" {{ old('type_client') == 'entreprise' ? 'selected' : '' }}>Entreprise</option>
                            </select>
                            @error('type_client')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('clients.index') }}" class="btn btn-secondary me-2">Annuler</a>
                            <button type="submit" class="btn btn-success px-4">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
