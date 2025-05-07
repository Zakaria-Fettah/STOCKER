<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des données d'inscription
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            
            'password' => Hash::make($request->password)
        ]);

        // Déclenche l'événement Registered (pour toute logique supplémentaire si nécessaire)
        event(new Registered($user));

        // Authentifie l'utilisateur immédiatement après son inscription
        Auth::login($user);

        // Redirection vers le tableau de bord
        // return redirect(RouteServiceProvider::HOME);
        Route::get('/signin', [AuthenticatedSessionController::class, 'create'])->name('signin');
    }
}
