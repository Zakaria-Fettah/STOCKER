@extends('layout.mainlayout')

@section('content')
<div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
    <h1>Liste des Clients</h1>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('clients.index') }}" class="input-group mb-4" style="max-width: 400px;">
        <input type="text" name="search" class="form-control" placeholder="Rechercher par nom, prénom, email..." value="{{ old('search', $search ?? '') }}">
        <button type="submit" class="btn btn-primary rounded" title="Rechercher">
            <i class="fas fa-search"></i>
        </button>
    </form>

    {{-- Add Client Button --}}
    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3" id="ajouterClient">
        <i class="fas fa-user-plus me-2"></i>Ajouter un Client
    </a>

    {{-- Clients Table --}}
    @if ($clients->isEmpty())
        <div class="alert alert-info" role="alert">
            Aucun client trouvé.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Type de client</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->nom ?? 'N/A' }}</td>
                            <td>{{ $client->prenom ?? 'N/A' }}</td>
                            <td>{{ $client->email ?? 'N/A' }}</td>
                            <td>{{ $client->type_client ?? 'N/A' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm rounded" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm rounded mx-1 btn-modifier" title="Modifier" data-id="{{ $client->id }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm rounded btn-supprimer" title="Supprimer" 
                                           data-id="{{ $client->id }}" data-nom="{{ $client->nom }} {{ $client->prenom }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <form id="form-delete-{{ $client->id }}" action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $clients->withQueryString()->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>

{{-- Inclure SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Afficher l'alerte de succès si présente dans la session
        @if (session('success'))
            Swal.fire({
                title: "Succès!",
                text: "{{ session('success') }}",
                icon: "success"
            });
        @endif

        // Gestion de la suppression avec SweetAlert
        const deleteButtons = document.querySelectorAll('.btn-supprimer');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const clientId = this.getAttribute('data-id');
                const clientNom = this.getAttribute('data-nom');
                
                Swal.fire({
                    title: "Êtes-vous sûr?",
                    text: `Voulez-vous vraiment supprimer le client ${clientNom}?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Oui, supprimer!",
                    cancelButtonText: "Annuler"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Soumettre le formulaire de suppression
                        document.getElementById(`form-delete-${clientId}`).submit();
                    }
                });
            });
        });

        // Ajout de listeners pour les boutons de modification (facultatif, car redirection)
        const modifierButtons = document.querySelectorAll('.btn-modifier');
        modifierButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Option: si vous voulez montrer l'alerte avant la redirection
                // e.preventDefault();
                // const clientId = this.getAttribute('data-id');
                // Swal.fire({
                //     title: "Modification",
                //     text: "Redirection vers la page de modification...",
                //     icon: "info",
                //     timer: 1500,
                //     showConfirmButton: false
                // }).then(() => {
                //     window.location.href = this.getAttribute('href');
                // });
            });
        });
    });
</script>
@endsection