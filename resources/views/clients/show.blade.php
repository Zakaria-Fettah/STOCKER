@extends('layout.mainlayout')

@section('content')
<div class="container " style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="h4 mb-0">Détails du Client</h1>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Nom:</strong> {{ $client->nom }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Prénom:</strong> {{ $client->prenom }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Email:</strong> {{ $client->email }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Téléphone:</strong> {{ $client->telephone }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Adresse:</strong> {{ $client->adresse }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Type de Client:</strong> {{ $client->type_client }}</p>
                </div>
            </div>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection