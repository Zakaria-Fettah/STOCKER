<?php $page = 'connexion-2'; ?>
@extends('layout.auth')

@section('content')
<div class="login-wrapper">
    <div class="login-content">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="login-userset">
                <div class="login-logo logo-normal">
                    <img src="{{ URL::asset('/build/img/logo.png') }}" alt="logo">
                </div>
                <a href="{{ url('index') }}" class="login-logo logo-white">
                    <img src="{{ URL::asset('/build/img/logo-white.png') }}" alt="logo blanc">
                </a>

                <div class="login-userheading">
                    <h3>Connexion</h3>
                    <h4>Accédez à votre compte avec votre email et mot de passe.</h4>
                </div>

                <!-- Email -->
                <div class="form-login">
                    <label>Adresse Email</label>
                    <div class="form-addons">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                        <img src="{{ URL::asset('/build/img/icons/mail.svg') }}" alt="email">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>

                <!-- Mot de passe -->
                <div class="form-login">
                    <label>Mot de passe</label>
                    <div class="pass-group">
                        <input type="password" class="pass-input" name="password" required autocomplete="current-password">
                        <span class="fas toggle-password fa-eye-slash"></span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>

                <!-- Se souvenir / Mot de passe oublié -->
                <div class="form-login authentication-check">
                    <div class="row">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox">
                                <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                    <input type="checkbox" name="remember">
                                    <span class="checkmarks"></span>Se souvenir de moi
                                </label>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            @if (Route::has('password.request'))
                                <a class="forgot-link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Bouton de connexion -->
                <div class="form-login">
                    <button type="submit" class="btn btn-login">Se connecter</button>
                </div>

                <!-- Lien vers l'inscription -->
                <!-- <div class="signinform">
                    <h4>Nouveau sur notre plateforme ? <a href="{{ route('register') }}" class="hover-a">Créer un compte</a></h4>
                </div> -->

                <!-- Connexion sociale -->
                <!-- <div class="form-setlogin or-text">
                    <h4>OU</h4>
                </div>
                <div class="form-sociallink">
                    <ul class="d-flex">
                        <li>
                            <a href="javascript:void(0);" class="facebook-logo">
                                <img src="{{ URL::asset('/build/img/icons/facebook-logo.svg') }}" alt="Facebook">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <img src="{{ URL::asset('/build/img/icons/google.png') }}" alt="Google">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="apple-logo">
                                <img src="{{ URL::asset('/build/img/icons/apple-logo.svg') }}" alt="Apple">
                            </a>
                        </li>
                    </ul>
                </div> -->

                <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                    <p>Copyright &copy; 2025 Stocker. Tous droits réservés.</p>
                </div>
            </div>
        </form>
    </div>

    <div class="login-img">
        <img src="{{ URL::asset('/build/img/authentication/login02.png') }}" alt="image de connexion">
    </div>
</div>
@endsection
