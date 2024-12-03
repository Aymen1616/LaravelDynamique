<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Ville;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create()
{
    return view('auth.login');  
}
    // Inscription d'un utilisateur (registre)
    public function register(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'telephone' => 'required|string|max:15|unique:etudiants',
            'adresse' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'ville_id' => 'required|exists:villes,id',
        ]);
    
        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        $etudiant = Etudiant::create([
            'nom' => $request->name,  
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'ville_id' => $request->ville_id,
            'user_id' => $user->id,  
        ]);
    
        Auth::login($user);
    
        return redirect()->route('login');
    }
    // Déconnexion de l'utilisateur
    public function destroy()
    {
        Auth::logout(); // Déconnexion
        return redirect()->route('login'); 
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
        // Redirection vers la page de profil de l'utilisateur après la connexion
        return redirect()->route('profil');
    }
    return back()->withErrors(['email' => 'Identifiants incorrects']);
}


public function showRegisterForm()
{
    $villes = Ville::all(); 
    return view('auth.register', ['villes' => $villes]);
}

}
