@extends('layout.mainlayout')

@section('content')
    <h1>Liste des envois clients</h1>
    <a href="{{ route('envoi_clients.create') }}" class="btn btn-primary">Ajouter un envoi</a>
    <table class="table">
        <thead>
            <tr>
                <th>Client</th>
                <th>Commande</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($envois as $envoi)
                <tr>
                    <td>{{ $envoi->client->name }}</td>
                    <td>{{ $envoi->commande->numero }}</td>
                    <td>
                        <a href="{{ route('envoi_clients.show', $envoi->id) }}">Voir</a>
                        <a href="{{ route('envoi_clients.edit', $envoi->id) }}">Éditer</a>
                        <form action="{{ route('envoi_clients.destroy', $envoi->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
