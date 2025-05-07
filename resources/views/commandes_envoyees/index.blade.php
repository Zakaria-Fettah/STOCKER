@extends('layout.mainlayout')

@section('content')
    <div class="container" style="margin-left: 20%; max-width: 1030px; margin-top: 80px;">
        <h1>Liste des commandes envoyées</h1>

        <!-- Formulaire de recherche -->
        <form method="GET" action="{{ route('commandes_envoyees.index') }}" class="input-group mb-4">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par client..." value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-secondary">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <!-- Bouton ajouter -->
        <a href="{{ route('commandes_envoyees.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Ajouter une commande envoyée
        </a>

        <!-- Tableau -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Date de commande</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($commandes as $commande)
                    <tr>
                        <td>{{ $commande->client->nom ?? 'Non spécifié' }}</td>
                        <td>{{ $commande->dateCommande }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $commande->statut)) }}</td>
                        <td>
                            <!-- Bouton Voir -->
                            <a href="{{ route('commandes_envoyees.show', $commande->id) }}" class="btn btn-info btn-sm" title="Voir">
                            <i class="fas fa-eye"></i>  
                            </a>
                            <!-- Bouton Modifier -->
                            <a href="{{ route('commandes_envoyees.edit', $commande->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                            <i class="fas fa-edit"></i> 
                            </a>
                            <!-- Bouton Supprimer -->
                            <form action="{{ route('commandes_envoyees.destroy', $commande->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                                <i class="fas fa-trash"></i>  
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Aucune commande envoyée trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>




        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3">
            {{ $commandes->appends(['search' => $search])->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@push('styles')
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endpush
