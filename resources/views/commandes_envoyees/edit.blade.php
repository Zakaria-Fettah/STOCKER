@extends('layout.mainlayout')

@section('content')
    <div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
        <h1>Modifier la commande envoyée</h1>
        <form action="{{ route('commandes_envoyees.update', $commande->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="dateCommande">Date de commande</label>
                <input type="date" class="form-control" id="dateCommande" name="dateCommande" value="{{ $commande->dateCommande }}" required>
            </div>
            <div class="form-group">
                <label for="statut">Statut</label>
                <select class="form-control" id="statut" name="statut">
                    <option value="en_attente" {{ $commande->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="envoyée" {{ $commande->statut == 'envoyée' ? 'selected' : '' }}>Envoyée</option>
                    <option value="annulée" {{ $commande->statut == 'annulée' ? 'selected' : '' }}>Annulée</option>
                    <option value="livrée" {{ $commande->statut == 'livrée' ? 'selected' : '' }}>Livrée</option>
                </select>
            </div>

            <div class="form-group">
                <label for="client_id">Client</label>
                <select class="form-control" id="client_id" name="client_id" required>
                    <option value="" disabled selected>Choisir un client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ $commande->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-warning">Mettre à jour</button>
        </form>
    </div>
@endsection
