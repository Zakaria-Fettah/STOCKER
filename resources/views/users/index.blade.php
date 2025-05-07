@extends('layout.mainlayout')

@section('content')
<div class="container py-4" style="margin-top:50px; margin-left: 20%;max-width: 80%;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Gestion des utilisateurs</h2>
            <a class="btn btn-light btn-sm" href="{{ route('users.create') }}" title="Créer un nouvel utilisateur" style="border-radius: 5px;">
                <i class="fas fa-plus me-2"></i>
            </a>
        </div>

        <div class="card-body">

            <!-- 🔍 Formulaire de recherche -->
            <form method="GET" action="{{ route('users.index') }}" class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Rechercher un utilisateur..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-primary" title="Rechercher un utilisateur" style="border-radius: 5px;">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rôles</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->getRoleNames() as $v)
                                        <span class="badge bg-success me-1">{{ $v }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-info btn-sm me-2" href="{{ route('users.show',$user->id) }}" title="Voir les détails" style="border-radius: 5px;">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-primary btn-sm me-2" href="{{ route('users.edit',$user->id) }}" title="Modifier l'utilisateur" style="border-radius: 5px;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Bouton de suppression avec SweetAlert -->
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm me-2" onclick="confirmDelete({{ $user->id }})" title="Supprimer l'utilisateur" style="border-radius: 5px;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {!! $data->appends(['search' => request('search')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>

<!-- ✅ SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ✅ Confirmation avant suppression -->
<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }
</script>

<!-- ✅ Afficher une alerte SweetAlert2 si succès (après ajout / modif / suppression) -->
@if (session('success'))
<script>
    Swal.fire({
        title: "Bravo !",
        text: "{{ session('success') }}",
        icon: "success",
        confirmButtonText: "OK"
    });
</script>
@endif

@endsection
