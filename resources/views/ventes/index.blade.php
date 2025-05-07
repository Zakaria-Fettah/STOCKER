@extends('layout.mainlayout')

@section('content')
<div class="container" style="margin-left: 20%; max-width: 1040px; margin-top: 80px;">
    <h2>Liste des Ventes</h2>

    <!-- Message de succès -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                });
            });
        </script>
    @endif

    <!-- Formulaire de recherche -->
    <form method="GET" action="{{ route('ventes.index') }}" class="input-group mb-3">
        <input type="text" name="search" class="form-control" placeholder="Rechercher par client, produit..." value="{{ $search ?? '' }}">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </form>

    <!-- Bouton ajouter une vente -->
    <a href="{{ route('ventes.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Ajouter une Vente
    </a>

    <!-- Tableau des ventes -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Client</th>
                <th>Stock</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
                <th>Bénéfice</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ventes as $vente)
                <tr>
                    <td>{{ $vente->produit->nom ?? 'N/A' }}</td>
                    <td>{{ $vente->client->nom ?? 'N/A' }}</td>
                    <td>{{ $vente->stock->id ?? 'N/A' }}</td>
                    <td>{{ $vente->quantiteVendue }}</td>
                    <td>{{ number_format($vente->prixUnitaire, 2) }} DH</td>
                    <td>{{ number_format($vente->total, 2) }} DH</td>
                    <td>{{ number_format($vente->benifice, 2) }} DH</td>
                    <td>
                        <a href="{{ route('ventes.show', $vente->id) }}" class="btn btn-info btn-sm" title="Voir"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('ventes.edit', $vente->id) }}" class="btn btn-warning btn-sm" title="Modifier"><i class="fas fa-edit"></i></a>
                        <form class="delete-form" action="{{ route('ventes.destroy', $vente->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm delete-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <a href="{{ route('generate.invoice', $vente->id) }}" class="btn btn-primary btn-sm" title="Générer la facture">
                            <i class="fas fa-file-invoice"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Aucune vente enregistrée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-end mt-3">
        {{ $ventes->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endpush

@push('scripts')
    <!-- CDN for SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert2 for delete confirmation -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteBtns = document.querySelectorAll('.delete-btn');

            deleteBtns.forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const form = btn.closest('form');
                    
                    // Display SweetAlert2 confirmation dialog
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
                            // On confirmation, submit the form and show the success alert
                            form.submit();
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                        }
                    });
                });
            });
        });
    </script>
@endpush
