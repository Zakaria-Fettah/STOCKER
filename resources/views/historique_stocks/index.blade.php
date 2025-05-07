@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Liste des historiques de stock</h2>
    <a href="{{ route('historique-stocks.create') }}" class="btn btn-primary mb-3">Ajouter un historique</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Fournisseur</th>
                <th>Produit</th>
                <th>Bénéfice</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($historiques as $historique)
                <tr>
                    <td>{{ $historique->id }}</td>
                    <td>{{ $historique->client->nom ?? '' }}</td>
                    <td>{{ $historique->fournisseur->nom ?? '' }}</td>
                    <td>{{ $historique->produit->libelle ?? '' }}</td>
                    <td>{{ $historique->benifice }} DH</td>
                    <td>
                        <a href="{{ route('historique-stocks.edit', $historique->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="{{ route('historique-stocks.show', $historique->id) }}" class="btn btn-info btn-sm">Voir</a>

                        <form action="{{ route('historique-stocks.destroy', $historique->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet historique ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
