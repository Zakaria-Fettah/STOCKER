@extends('layout.mainlayout')

@section('content')
<div class="container py-4" style="margin-top:50px; margin-left: 20%; max-width: 80%;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Détails de l'utilisateur</h2>
            <a class="btn btn-light btn-sm" href="{{ route('users.index') }}">
                <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
        </div>

        <div class="card-body">
            <div class="row g-3">
                <!-- Nom -->
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label fw-bold">Nom</label>
                        <p class="form-control-plaintext">{{ $user->name }}</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label fw-bold">Email</label>
                        <p class="form-control-plaintext">{{ $user->email }}</p>
                    </div>
                </div>

                <!-- Rôles -->
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label fw-bold">Rôles</label>
                        <div>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <span class="badge bg-success me-1">{{ $v }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">Aucun rôle attribué</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Bouton de modification -->
                <div class="col-12 text-center mt-4">
                    <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">
                        <i class="fas fa-edit me-2"></i>Modifier l'utilisateur
                    </a>
                </div>
            </div>
        </div>
    </div>

    <p class="text-center text-muted mt-4">
    </p>
</div>
@endsection
