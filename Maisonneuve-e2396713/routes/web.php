<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ici, vous pouvez enregistrer des routes web pour votre application. 
| Ces routes sont chargées par le RouteServiceProvider dans un groupe 
| qui contient le middleware "web".
|
*/

// Route d'accueil
Route::get('/', function () {
    return view('layout');
});

// Routes publiques (pas protégées)
// Route::get('/login', [AuthController::class, 'create'])->name('login');
// Route::post('/login', [AuthController::class, 'store'])->name('login.store');
// Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

// Groupes de routes protégées par le middleware auth
Route::middleware(['auth'])->group(function () {

    // Route pour l'index des étudiants
    Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');

    // Route pour créer un étudiant
    Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
    Route::post('/etudiants', [EtudiantController::class, 'store'])->name('etudiants.store');

    // Route pour afficher les détails d'un étudiant
    Route::get('/etudiants/{etudiant}', [EtudiantController::class, 'show'])->name('etudiants.show');

    // Route pour modifier un étudiant
    Route::get('/etudiants/{etudiant}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
    Route::put('/etudiants/{etudiant}', [EtudiantController::class, 'update'])->name('etudiants.update');

    // Route pour supprimer un étudiant
    Route::delete('/etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');

});
// Route pour afficher le formulaire d'inscription
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');

// Route pour traiter l'inscription de l'utilisateur
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

// Route pour afficher le formulaire de connexion
Route::get('/login', [AuthController::class, 'create'])->name('login');

// Route pour traiter la connexion
Route::post('/login', [AuthController::class, 'store'])->name('login.store');

// Route pour la déconnexion
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

// Page de profil de l'utilisateur
Route::get('/profil', [EtudiantController::class, 'profil'])->name('profil')->middleware('auth');
