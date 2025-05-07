@extends('layout.mainlayout')

<style>
    .container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        width: 60%;
        padding-right: calc(var(--bs-gutter-x) * .5);
        padding-left: calc(var(--bs-gutter-x) * .5);
        margin-right: auto;
        margin-left: 20%;
        padding-top: 100px;
        max-width: 1040px;
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        list-style: none;
        padding: 0;
        margin: 20px 0;
    }

    .pagination li {
        display: inline-flex;
        align-items: center;
    }

    .pagination li a,
    .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px 12px;
        font-size: 14px;
        line-height: 1.5;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .pagination li a:hover {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .pagination .active span {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
        cursor: default;
    }

    .pagination .disabled span,
    .pagination .disabled a {
        color: #6c757d;
        background-color: #f8f9fa;
        border-color: #dee2e6;
        cursor: not-allowed;
        pointer-events: none;
    }

    .btn-outline-secondary i {
        color: #007bff;
    }

    .btn-outline-secondary:hover i {
        color: #007bff;
    }

    @media (max-width: 576px) {
        .pagination li a,
        .pagination li span {
            padding: 6px 10px;
            font-size: 12px;
        }
    }
</style>

@section('content')
<div class="container mt-4" style="margin-left: 20%; max-width: 1040px;">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Liste des produits</h4>
            <a href="{{ route('products.create') }}" class="btn btn-success btn-sm" style="border-radius: 5px;" title="Ajouter un produit">
                <i class="fas fa-plus"></i> Ajouter un produit
            </a>
        </div>

        <div class="card-body">
            {{-- Formulaire de recherche --}}
            <form method="GET" action="{{ route('products.index') }}" class="input-group mb-3" style="max-width: 400px;">
                <input type="text" name="search" class="form-control" placeholder="Rechercher un produit..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-secondary" title="Rechercher" style="border-radius: 5px;">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->nom }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->prix }} MAD</td>
                            <td>{{ $product->quantite }}</td>
                            <td>{{ $product->category->nomCategorie ?? 'Non défini' }}</td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="confirmDelete(event, this)">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Aucun produit trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

<!-- ✅ SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ✅ Script personnalisé -->
<script>
    // ✅ Confirmation avant suppression
    function confirmDelete(event, form) {
        event.preventDefault();

        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Ce produit sera définitivement supprimé.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    // ✅ Notification de succès
    @if (session('success'))
        Swal.fire({
            title: 'Succès',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif
</script>
