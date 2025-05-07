@extends('layout.mainlayout')

@section('content')
    <h1>Détails de l'envoi</h1>
    <p><strong>Client :</strong> {{ $envoi->client->name }}</p>
    <p><strong>Commande :</strong> {{ $envoi->commande->numero }}</p>
    <a href="{{ route('envoi_clients.index') }}" class="btn btn-primary">Retour à la liste</a>
@endsection
