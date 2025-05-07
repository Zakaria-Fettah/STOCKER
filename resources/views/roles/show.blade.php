@extends('layout.mainlayout')

@section('content')
    <div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Afficher le rôle</h2>
            <a class="btn btn-primary" href="{{ route('roles.index') }}">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="mb-4">
                    <strong class="d-block text-muted mb-1">Nom :</strong>
                    <span class="fs-5 fw-bold">{{ $role->name }}</span>
                </div>

                <div>
                    <strong class="d-block text-muted mb-2">Permissions :</strong>
                    <div class="d-flex flex-wrap gap-2">
                        @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                                <span class="badge bg-danger">{{ $v->name }}</span>
                            @endforeach
                        @else
                            <span class="text-muted fst-italic">Aucune permission assignée</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclusion des icônes Bootstrap pour le bouton Retour -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
@endsection
