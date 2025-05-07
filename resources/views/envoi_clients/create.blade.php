@extends('layout.mainlayout')

@section('content')
    <h1>Créer un envoi client</h1>
    <form action="{{ route('envoi_clients.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="idClient">Client</label>
            <select name="idClient" id="idClient" class="form-control" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="idCommandeEnvoyee">Commande</label>
            <select name="idCommandeEnvoyee" id="idCommandeEnvoyee" class="form-control" required>
                @foreach($commandes as $commande)
                    <option value="{{ $commande->id }}">{{ $commande->numero }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
