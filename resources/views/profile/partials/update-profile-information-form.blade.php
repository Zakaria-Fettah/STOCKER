<section class="mb-5">
    <header class="mb-4">
        <h2 class="h4 text-dark">
            {{ __('Informations du profil') }}
        </h2>

        <p class="text-muted mb-0">
            {{ __("Mettez à jour les informations de votre profil et votre adresse e-mail.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Nom') }}</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Adresse e-mail') }}</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-muted">
                        {{ __('Votre adresse e-mail n’est pas vérifiée.') }}

                        <button form="send-verification" class="btn btn-link p-0 text-decoration-none">
                            {{ __('Cliquez ici pour renvoyer l’e-mail de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success mt-2 mb-0">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">{{ __('Enregistrer') }}</button>

            @if (session('status') === 'profile-updated')
                <div class="text-muted" id="status-message">
                    {{ __('Enregistré.') }}
                </div>
                <script>
                    setTimeout(() => {
                        document.getElementById('status-message').style.display = 'none';
                    }, 2000);
                </script>
            @endif
        </div>
    </form>
</section>
