@extends('layout.mainlayout')

@section('content')
    <div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
        <h1>Détails de la commande envoyée</h1>
        <table class="table">
            <tr>
                <th>Date de commande</th>
                <td>{{ $commande->dateCommande }}</td>
            </tr>
            <tr>
                <th>Statut</th>
                <td class="{{ $commande->statut == 'envoyée' ? 'text-success' : ($commande->statut == 'annulée' ? 'text-danger' : 'text-warning') }}">
                    {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                </td>
            </tr>
            <tr>
                <th>Client</th>
                <td>{{ $commande->client->nom }}</td>
            </tr>
        </table>
        <a href="{{ route('commandes_envoyees.index') }}" class="btn btn-primary">Retour à la liste</a>
    </div>
@endsection
