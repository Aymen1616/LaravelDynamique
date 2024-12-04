<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SetLocaleController;
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



Route::get('/lang/{locale}', [SetLocaleController::class, 'index'])->name('lang');

use App\Http\Controllers\ArticleController;

Route::middleware(['auth'])->group(function () {
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

use App\Http\Controllers\FileController;

Route::resource('files', FileController::class);
Route::get('/files/create', [FileController::class, 'create'])->name('files.create');
Route::post('/files', [FileController::class, 'store'])->name('files.store');
Route::get('/files/{file}/edit', [FileController::class, 'edit'])->name('files.edit');
Route::put('/files/{file}', [FileController::class, 'update'])->name('files.update');
