<section class="mb-5">
    <header class="mb-4">
        <h2 class="h4 text-dark">
            {{ __('Supprimer le compte') }}
        </h2>
        <p class="text-muted">
            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.') }}
        </p>
    </header>

    <button 
        type="button" 
        class="btn btn-danger" 
        data-bs-toggle="modal" 
        data-bs-target="#confirmUserDeletion"
    >
        {{ __('Supprimer le compte') }}
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUserDeletionLabel">
                            {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    
                    <div class="modal-body">
                        <p class="text-muted mb-4">
                            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}
                        </p>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label visually-hidden">{{ __('Mot de passe') }}</label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password" 
                                name="password" 
                                placeholder="{{ __('Mot de passe') }}"
                                required
                            >
                            @error('password', 'userDeletion')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Annuler') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            {{ __('Supprimer le compte') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
