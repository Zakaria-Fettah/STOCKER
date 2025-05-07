<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\categoriescontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AchatController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RegistredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FournisseurCommandeController;
use App\Http\Controllers\EnvoiClientController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CommandeRecueController;
use App\Http\Controllers\CommandesEnvoyeesController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\HistoriqueStockController;

Route::get('/ventes-par-jour', [VenteController::class, 'ventesParJour'])->name('ventes.par.jour');

Route::post('/profile/image', [UserController::class, 'updateProfileImage'])->name('profile.image.update');
Route::get('/get-produit-price/{id}', [VenteController::class, 'getProduitPrice'])->name('produits.getPrice');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified']) // Tu peux ajouter un middleware is_admin ici aussi
    ->name('dashboard');
// Route existante
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
Route::post('/profile/update-image', [UserController::class, 'updateProfileImage'])->name('updateProfileImage');
Route::post('/profile/image', [UserController::class, 'updateProfileImage'])->name('profile.image.update');
// Nouvelle route pour les données AJAX
Route::get('/dashboard/donnees', [App\Http\Controllers\DashboardController::class, 'getVentesDonnees'])->name('dashboard.donnees');

Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/categories/{categorieId}/produits', [ProduitController::class, 'getProduitsByCategory'])->name('categories.produits');

Route::resource('historique-stocks', HistoriqueStockController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/messages/{id}', [ChatController::class, 'getMessages']);
    Route::post('/messages', [ChatController::class, 'store']);
});
// Route de recherche des catégories
Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');

Route::post('/commandes_envoyees', [CommandeEnvoyeeController::class, 'store'])->name('commandes_envoyees.store');

Route::resource('fournisseur_commandes', FournisseurCommandeController::class);

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/messages/{userId}', [ChatController::class, 'getMessages'])->name('chat.getMessages');
Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');
Route::post('/send-audio', [ChatController::class, 'sendAudioMessage'])->name('chat.sendAudioMessage');

Route::post('/update-read-status', function (Request $request) {
    $message = \App\Models\Chat::find($request->message_id);
    if ($message && $message->receiver_id == Auth::id()) {
        $message->read_status = 1;
        $message->save();
    }
    return response()->json(['status' => 'success']);
});
Route::get('/search-users', [ChatController::class, 'searchUsers'])->name('search.users');

Route::post('/block-user', [ChatController::class, 'blockUser'])->name('block.user');
Route::post('/unblock-user', [ChatController::class, 'unblockUser'])->name('unblock.user');
Route::post('/messages/read', [ChatController::class, 'markAsRead']);

Route::get('/generate-invoice', [InvoiceController::class, 'generatePDF']);

Route::get('/generate-invoice/{venteId}', [InvoiceController::class, 'generatePDF'])->name('generate.invoice');

Route::resource('users', UserController::class);

Route::resource('livraisons', LivraisonController::class);

Route::resource('commande-recues', CommandeRecueController::class);

Route::resource('commandes_envoyees', CommandesEnvoyeesController::class);

Route::resource('clients', ClientController::class);

Route::resource('permissions', PermissionController::class);

Route::resource('ventes', VenteController::class);

Route::resource('stocks', StockController::class);

Route::resource('envoi_clients', EnvoiClientController::class);

Route::resource('fournisseurcommande', FournisseurCommandeController::class);
// routes/web.php
Route::resource('commandes-envoyees', CommandeEnvoyeeController::class);

// Route pour afficher les commandes reçues
Route::get('/commandes-recues', [CommandeController::class, 'commandesRecues'])->name('commandes-recues.index');

Route::resource('commande_recues', CommandeRecueController::class);

Route::resource('clients', ClientController::class);

Route::resource('achats', AchatController::class);

Route::resource('fournisseurs', FournisseurController::class);

// awal 7aja katla3 mni kanraniw server
Route::get('/', function () {
    return view('Auth.login');
});
// 
Route::post('products', [ProduitController::class, 'store'])->name('products.store');
Route::resource('products', ProduitController::class);

Route::post('/register', [RegistredUserController::class, 'customRegister'])->name('register.custom');

Route::get('/signin-2', function () {
    return view('singin-2');
})->name('signin-2');

Route::get('/signin-2', [AuthenticatedSessionController::class, 'create'])->name('signin-2');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('/index', function () {
    return view('index');
})->name('index');

Route::resource('categories', CategoryController::class);
Route::resource('categoriess', categoriescontroller::class);

Route::get('add-product', [ProductController::class, 'create']);

Route::get('ventes/create', [VenteController::class, 'create'])->name('ventes.create');
Route::post('ventes', [VenteController::class, 'store'])->name('ventes.store');

require __DIR__.'/auth.php';
