@extends('layout.mainlayout')

@section('content')
    <div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Gestion des rôles</h2>
            @can('role-create')
                <a class="btn btn-success d-flex align-items-center gap-2" href="{{ route('roles.create') }}" title="Créer un nouveau rôle">
                    <span>➕</span> Nouveau rôle
                </a>
            @endcan
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-bordered mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}" title="Voir les détails">👁</a>

                                    @can('role-edit')
                                        <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}" title="Modifier le rôle">✏</a>
                                    @endcan

                                    @can('role-delete')
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                            {!! Form::button('🗑', ['type' => 'button', 'class' => 'btn btn-danger btn-sm delete-role-btn', 'title' => 'Supprimer le rôle']) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {!! $roles->links('pagination::bootstrap-5') !!}
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script pour la confirmation de suppression -->
    <script>
        document.querySelectorAll('.delete-role-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: "Êtes-vous sûr ?",
                    text: "Cette action est irréversible !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Oui, supprimer !",
                    cancelButtonText: "Annuler"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <!-- Affichage du message de succès après ajout/modification -->
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: "Succès !",
                text: "{{ $message }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        </script>
    @endif
@endsection
