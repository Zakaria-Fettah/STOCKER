@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Ajouter un historique</h2>
    <form action="{{ route('historique-stocks.store') }}" method="POST">
        @csrf
        @include('historique_stocks.form')
        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection
