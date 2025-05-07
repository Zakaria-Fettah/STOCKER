@extends('layout.mainlayout')

@section('content')
<div class="container py-4" style="margin-top:50px; margin-left: 20%; max-width: 80%;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Modifier un utilisateur</h2>
            <a class="btn btn-light btn-sm" href="{{ route('users.index') }}">
                <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
        </div>

        <div class="card-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oups !</strong> Il y a eu des problèmes avec votre saisie :
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            @endif

            {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'class' => 'needs-validation', 'novalidate']) !!}
            <div class="row g-3">
                <!-- Nom -->
                <div class="col-12">
                    <div class="form-group">
                        <label for="name" class="form-label"><strong>Nom</strong></label>
                        {!! Form::text('name', null, ['placeholder' => 'Entrer le nom', 'class' => 'form-control', 'id' => 'name', 'required']) !!}
                        <div class="invalid-feedback">
                            Veuillez entrer un nom valide.
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-12">
                    <div class="form-group">
                        <label for="email" class="form-label"><strong>Email</strong></label>
                        {!! Form::email('email', null, ['placeholder' => 'Entrer l\'email', 'class' => 'form-control', 'id' => 'email', 'required']) !!}
                        <div class="invalid-feedback">
                            Veuillez entrer une adresse email valide.
                        </div>
                    </div>
                </div>

                <!-- Rôles -->
                <div class="col-12">
                    <div class="form-group">
                        <label for="roles" class="form-label"><strong>Rôles</strong></label>
                        {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-select', 'multiple', 'id' => 'roles', 'required']) !!}
                        <div class="invalid-feedback">
                            Veuillez sélectionner au moins un rôle.
                        </div>
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Mettre à jour
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <p class="text-center text-muted mt-4">
        <small>Tutoriel par ItSolutionStuff.com</small>
    </p>
</div>

@section('scripts')
<script>
    // Validation du formulaire avec Bootstrap
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection
@endsection
