<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Ville;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function __construct()
    {
        // Appliquer le middleware auth à toutes les actions du contrôleur
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etudiants = Etudiant::all();
        $villes = Ville::all();
        return view('etudiants.index', ['etudiants' => $etudiants, 'villes' => $villes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $villes = Ville::all(); 
        return view('etudiants.create', ['villes' => $villes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Vérifiez si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour ajouter un étudiant.');
        }
    
        // Validation des données de l'étudiant
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:15|unique:etudiants',
            'email' => 'required|email|max:255|unique:etudiants',
            'date_naissance' => 'required|date',
            'ville_id' => 'required|exists:villes,id',
        ]);
    
        // Créer l'étudiant et associer l'utilisateur connecté
        $etudiant = Etudiant::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'date_naissance' => $request->date_naissance,
            'ville_id' => $request->ville_id,
            'user_id' => Auth::id(),  // Associer l'utilisateur connecté
        ]);
    
        return redirect()->route('etudiants.index')->with('success', 'L\'étudiant a été ajouté avec succès.');
    }
    
    
    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
        // Vérifier que l'étudiant appartient à l'utilisateur connecté
        if ($etudiant->user_id != Auth::id()) {
            return redirect()->route('etudiants.index')->with('error', 'Vous n\'avez pas accès à cet étudiant.');
        }
    
        return view('etudiants.show', ['etudiant' => $etudiant]);
    }
    
    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiant)
    {
        $villes = Ville::all();
        return view('etudiants.edit', ['etudiant' => $etudiant, 'villes' => $villes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        // Vérifier que l'étudiant appartient à l'utilisateur connecté
        if ($etudiant->user_id != Auth::id()) {
            return redirect()->route('etudiants.index')->with('error', 'Vous n\'avez pas l\'autorisation de modifier cet étudiant.');
        }
    
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:15|unique:etudiants,telephone,' . $etudiant->id,
            'email' => 'required|email|max:255|unique:etudiants,email,' . $etudiant->id,
            'ville_id' => 'required|exists:villes,id',
        ]);
    
        $etudiant->update($request->all());
    
        return redirect()->route('etudiants.index')->with('success', 'Les informations de l\'étudiant ont été mises à jour.');
    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete(); 
        return redirect()->route('etudiants.index')->with('success', 'L\'étudiant a été supprimé.');
    }
}
