<?php $page = 'category-list'; ?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus"></i> Ajouter une catégorie
        </a>

        <!-- Formulaire de recherche -->
        <form action="{{ route('categories.index') }}" method="GET" class="d-flex mb-4">
            <input type="text" name="search" class="form-control me-2" placeholder="Rechercher une catégorie..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary">Rechercher</button>
        </form>

        <!-- Modal Ajout -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="categoryForm" method="POST" action="{{ route('categories.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Ajouter une Catégorie</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom de la catégorie</label>
                                <input type="text" class="form-control" id="name" name="nomCategorie" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tableau des catégories -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th class="no-sort"></th>
                                <th>Nom</th>
                                <th class="no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td></td>
                                <td>{{ $category->nomCategorie }}</td>
                                <td>
                                    <!-- Bouton Modifier -->
                                    <button type="button" class="btn btn-warning btn-sm editCategoryBtn" 
                                        data-id="{{ $category->id }}" 
                                        data-name="{{ $category->nomCategorie }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Formulaire Supprimer avec SweetAlert -->
                                    <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $category->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $categories->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Édition -->
        <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editCategoryForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Modifier la Catégorie</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="edit_category_id">
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Nom de la catégorie</label>
                                <input type="text" class="form-control" id="edit_name" name="nomCategorie" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- ✅ SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ✅ Script JS pour édition -->
<script>
    $(document).ready(function () {
        $('.editCategoryBtn').click(function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            $('#edit_category_id').val(id);
            $('#edit_name').val(name);
            $('#editCategoryForm').attr('action', '/categories/' + id);
            $('#editCategoryModal').modal('show');
        });
    });

    // ✅ Confirmation avant suppression
    function confirmDelete(categoryId) {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + categoryId).submit();
            }
        });
    }

    // ✅ Alerte de succès après action
    @if (session('success'))
        Swal.fire({
            title: 'Succès !',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endsection
