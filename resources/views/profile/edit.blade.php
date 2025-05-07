@extends('layout.mainlayout')

@section('content')
    <div class="container" style=" margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Carte pour les informations de profil -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h5 mb-0">{{ __('Informations du profil') }}</h2>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Carte pour mettre à jour le mot de passe -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h5 mb-0">{{ __('Mettre à jour le mot de passe') }}</h2>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Carte pour supprimer le compte -->
                <div class="card mb-4 border-danger">
                    <div class="card-header bg-danger text-white">
                        <h2 class="h5 mb-0">{{ __('Supprimer le compte') }}</h2>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
