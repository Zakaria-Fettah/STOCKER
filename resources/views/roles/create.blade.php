@extends('layout.mainlayout')

@section('content')
    <div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Créer un nouveau rôle</h2>
            <a class="btn btn-primary" href="{{ route('roles.index') }}">Retour</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oups !</strong> Il y a eu des problèmes avec votre saisie.<br><br>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        {!! Form::open(['route' => 'roles.store', 'method' => 'POST', 'class' => 'card shadow-sm p-4']) !!}
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-group">
                        <label for="name" class="form-label"><strong>Nom :</strong></label>
                        {!! Form::text('name', null, ['placeholder' => 'Nom du rôle', 'class' => 'form-control', 'id' => 'name']) !!}
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <strong>Permissions :</strong>
                        <div class="row">
                            @foreach($permission as $value)
                                <div class="col-12 col-md-6 col-lg-4 mb-2">
                                    <div class="form-check">
                                        {!! Form::checkbox('permission[]', $value->name, false, ['class' => 'form-check-input', 'id' => 'perm-' . $value->name]) !!}
                                        <label class="form-check-label" for="perm-{{ $value->name }}">{{ $value->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        {!! Form::close() !!}

        <p class="text-center text-muted mt-4"></p>
    </div>

    <!-- Inclusion de Bootstrap JS pour la fermeture des alertes -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
