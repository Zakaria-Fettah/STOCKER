<?php $page = 'signin-2'; ?>
@extends('layout.auth')

@section('content')
    <div class="account-content">
        <div class="login-wrapper">
            <div class="login-content">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="{{ URL::asset('/build/img/logo.png') }}" alt="img">
                        </div>
                        <a href="{{ url('index') }}" class="login-logo logo-white">
                            <img src="{{ URL::asset('/build/img/logo.png') }}" alt="">
                        </a>
                        <div class="login-userheading">
                            <h3>Mot de passe oublié ?</h3>
                            <h4>Si vous avez oublié votre mot de passe, nous vous enverrons un e-mail avec les instructions pour le réinitialiser.</h4>
                        </div>

                        <!-- Statut de session -->
                        <x-auth-session-status class="mb-4 text-success" :status="session('status')" />

                        <!-- Champ Email -->
                        <div class="form-login">
                            <label>Email</label>
                            <div class="form-addons">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                <img src="{{ URL::asset('/build/img/icons/mail.svg') }}" alt="img">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                        </div>

                        <!-- Bouton Envoyer -->
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">Envoyer le lien de réinitialisation</button>
                        </div>

                        <!-- Retour à la connexion -->
                        <div class="signinform text-center">
                            <h4>Retour à la <a href="{{ route('login') }}" class="hover-a">connexion</a></h4>
                        </div>

                        <!-- Footer -->
                        <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                            <p>Copyright &copy; 2025 STOCKER. Tous droits réservés.</p>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Image de droite -->
            <div class="login-img">
                <img src="{{ URL::asset('/build/img/authentication/forget.png') }}" alt="img">
            </div>
        </div>
    </div>
@endsection
