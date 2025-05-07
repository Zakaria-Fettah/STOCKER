@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Modifier un historique</h2>
    <form action="{{ route('historique-stocks.update', $historiqueStock->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('historique_stocks.form', ['historiqueStock' => $historiqueStock])
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
