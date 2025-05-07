@extends('layout.mainlayout')

@section('content')

    <div class="management-container">
        <div class="container" style="margin-left: 20%; max-width: 1000px; margin-top: 80px;">
            <div class="card">
                <div class="card-header">
                    Gestion des Livraisons
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="page-title">Liste des livraisons</h1>
                        <a href="{{ route('livraisons.create') }}" class="btn btn-primary">
                            <span>➕</span> Ajouter une livraison
                        </a>
                    </div>

                    <!-- Formulaire de recherche -->
                    <form method="GET" action="{{ route('livraisons.index') }}" class="input-group mb-4">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher par client ou produit..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>Client</th>
                                <th>Commande envoyée</th>
                                <th>Produit</th>
                                <th>Catégorie</th>
                                <th>Quantité</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>

                            <tbody>
                                @forelse ($livraisons as $livraison)
                                    <tr>
                                        <td>{{ $livraison->client->nom ?? 'N/A' }}</td>
                                        <td>{{ $livraison->commande->id ?? 'N/A' }}</td>
                                        <td>{{ $livraison->produit->nom ?? 'N/A' }}</td>
                                        <td>{{ $livraison->categorie->nomCategorie ?? 'N/A' }}</td>
                                        <td>{{ $livraison->quantite }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $livraison->statut)) }}</td>
                                        <td>{{ $livraison->date }}</td>
                                        <td class="action-buttons">
                                            <!-- Bouton Voir -->
                                            <a href="{{ route('livraisons.show', $livraison->id) }}" class="btn btn-info btn-sm" title="Voir">
                                                <i class="bi bi-eye"></i> 
                                            </a>

                                            <!-- Bouton Modifier -->
                                            <a href="{{ route('livraisons.edit', $livraison->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                                                <i class="bi bi-pencil"></i> 
                                            </a>

                                            <!-- Bouton Supprimer avec SweetAlert -->
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $livraison->id }})" title="Supprimer">
                                                <i class="bi bi-trash"></i> 
                                            </button>

                                            <!-- Formulaire caché -->
                                            <form id="delete-form-{{ $livraison->id }}" action="{{ route('livraisons.destroy', $livraison->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Aucune livraison trouvée.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($livraisons->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {!! $livraisons->appends(['search' => request('search')])->links('pagination::bootstrap-5') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert pour suppression -->
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

    <!-- SweetAlert pour succès -->
    @if (session('success'))
    <script>
        Swal.fire({
            title: "Good job!",
            text: "{{ session('success') }}",
            icon: "success"
        });
    </script>
    @endif

@endsection
