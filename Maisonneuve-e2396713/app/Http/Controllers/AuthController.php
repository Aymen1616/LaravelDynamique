<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Formulaire de connexion
    public function create()
    {
        return view('auth.create'); // Formulaire de connexion
    }

    // Connexion de l'utilisateur
    public function store(Request $request)
    {
        // Validation des données de l'utilisateur
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Tentative de connexion
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirection après une connexion réussie
            return redirect()->route('etudiants.index');
        }

        // Si la connexion échoue, renvoyer l'utilisateur au formulaire avec un message d'erreur
        return back()->withErrors(['email' => 'Identifiants incorrects']);
    }

    // Déconnexion de l'utilisateur
    public function destroy()
    {
        Auth::logout(); // Déconnexion
        return redirect()->route('login'); // Redirection vers la page de connexion
    }

    // Inscription d'un utilisateur (registre)
    public function register(Request $request)
    {
        // Validation des données de l'utilisateur
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Création de l'utilisateur avec le mot de passe crypté
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Cryptage du mot de passe
        ]);

        // Authentification automatique de l'utilisateur
        Auth::login($user);

        // Redirection vers la page d'accueil après inscription
        return redirect()->route('etudiants.index');
    }

    public function showRegisterForm()
    {
    return view('auth.register'); 
    }
}
