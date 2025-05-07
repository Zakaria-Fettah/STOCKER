<?php $page = 'signin-2'; ?>
@extends('layout.auth')

@section('content')
    <div class="account-content">
        <div class="login-wrapper bg-img">
            <div class="login-content">
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">

                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="{{ URL::asset('/build/img/logo.png') }}" alt="img">
                        </div>
                        <a href="{{ url('index') }}" class="login-logo logo-white">
                            <img src="{{ URL::asset('/build/img/logo-white.png') }}" alt="">
                        </a>
                        <div class="login-userheading">
                            <h3>Réinitialiser le mot de passe ?</h3>
                            <h4>Entrez le nouveau mot de passe et sa confirmation pour accéder à votre compte</h4>
                        </div>

                        <!-- Email -->
                        <div class="form-login">
                            <label>Email</label>
                            <div class="form-addons">
                                <input type="email" class="form-control" name="email" value="{{ old('email', request()->email) }}" required autofocus>
                                <img src="{{ URL::asset('/build/img/icons/mail.svg') }}" alt="img">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                        </div>

                        <!-- Nouveau mot de passe -->
                        <div class="form-login">
                            <label>Nouveau mot de passe</label>
                            <div class="pass-group">
                                <input type="password" class="pass-inputa" name="password" required autocomplete="new-password">
                                <span class="fas toggle-passworda fa-eye-slash"></span>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                        </div>

                        <!-- Confirmer le mot de passe -->
                        <div class="form-login">
                            <label>Confirmer le mot de passe</label>
                            <div class="pass-group">
                                <input type="password" class="pass-inputs" name="password_confirmation" required autocomplete="new-password">
                                <span class="fas toggle-passwords fa-eye-slash"></span>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                        </div>

                        <!-- Bouton soumettre -->
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">Changer le mot de passe</button>
                        </div>

                        <!-- Retour à la connexion -->
                        <div class="signinform text-center">
                            <h4>Retour à la <a href="{{ route('login') }}" class="hover-a">connexion</a></h4>
                        </div>

                        <!-- Pied de page -->
                        <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                            <p>&copy; 2025 STOCKER. Tous droits réservés.</p>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Image de droite -->
            <div class="login-img">
                <img src="{{ URL::asset('/build/img/authentication/reset.png') }}" alt="img">
            </div>
        </div>
    </div>
@endsection
