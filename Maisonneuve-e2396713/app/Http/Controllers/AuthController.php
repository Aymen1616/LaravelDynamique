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
    // Formulaire de connexion
    public function create()
    {
        return view('auth.create'); // Formulaire de connexion
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
            'name' => $request->name,  // Utilisation du même nom
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Création de l'étudiant avec le même nom et l'association à l'utilisateur
        $etudiant = Etudiant::create([
            'nom' => $request->name,  // Utilisation du même nom
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'ville_id' => $request->ville_id,
            'user_id' => $user->id,  // Association de l'utilisateur à l'étudiant
        ]);
    
        // Connexion de l'utilisateur (qui est aussi l'étudiant)
        Auth::login($user);
    
        // Redirection vers la page connexion
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

    // Si la connexion échoue, renvoyer l'utilisateur au formulaire avec un message d'erreur
    return back()->withErrors(['email' => 'Identifiants incorrects']);
}

// Dans AuthController
public function showRegisterForm()
{
    // Récupérer les villes depuis la base de données
    $villes = Ville::all(); 

    // Passer les villes à la vue
    return view('auth.register', ['villes' => $villes]);
}

}
