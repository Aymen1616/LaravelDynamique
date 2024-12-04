<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function index()
    {
        // Affichage des fichiers avec pagination
        $files = File::latest()->paginate(10);  // 10 fichiers par page
        return view('files.index', compact('files'));
    }

    public function create()
    {
        return view('files.create');
    }

    public function store(Request $request)
    {
        // Validation du fichier
        $request->validate([
            'file' => 'required|file|mimes:pdf,zip,doc|max:10240', 
        ]);
    
        // Sauvegarde du fichier dans le dossier 'public/files'
        $path = $request->file('file')->store('files', 'public');
    
        // Enregistrer les informations du fichier dans la base de données
        $file = new File();
        $file->title_fr = $request->input('title_fr');
        $file->title_en = $request->input('title_en');
        $file->path = $path;
        $file->user_id = auth()->id(); 
        $file->save();
    
        return redirect()->route('files.index')->with('success', 'Le fichier a été téléchargé avec succès.');
    }
    
    public function edit($id)
    {
        $file = File::findOrFail($id);

        // Vérifier si l'utilisateur est le propriétaire du fichier
        if ($file->user_id != auth()->id()) {
            return redirect()->route('files.index')->with('error', 'Vous n\'avez pas l\'autorisation de modifier ce fichier.');
        }

        return view('files.edit', compact('file'));
    }

    public function update(Request $request, $id)
    {
        $file = File::findOrFail($id);
    
        // Vérifiez si l'utilisateur est le propriétaire du fichier
        if ($file->user_id != auth()->id()) {
            return redirect()->route('files.index')->with('error', 'Vous n\'avez pas l\'autorisation de modifier ce fichier.');
        }
    
        // Validation des champs
        $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,zip,doc|max:2048',
        ]);
    
        // Mettre à jour les titres en français et en anglais
        $file->title_fr = $request->title_fr;
        $file->title_en = $request->title_en;
    
        // Si un nouveau fichier est téléchargé, on remplace l'ancien fichier
        if ($request->hasFile('file')) {
            // Supprimer l'ancien fichier
            Storage::delete($file->path);
    
            // Enregistrer le nouveau fichier dans le dossier 'public/files'
            $path = $request->file('file')->store('files', 'public');
            $file->path = $path;
        }
    
        // Sauvegarder les changements
        $file->save();
    
        return redirect()->route('files.index')->with('success', 'Le fichier a été mis à jour.');
    }
    
    public function destroy(File $file)
    {
        // Vérifier que l'utilisateur a partagé ce fichier
        if ($file->user_id != Auth::id()) {
            return redirect()->route('files.index')->with('error', 'Vous n\'avez pas l\'autorisation de supprimer ce fichier.');
        }

        // Supprimer le fichier du système de fichiers
        Storage::delete($file->path);

        // Supprimer le fichier de la base de données
        $file->delete();

        return redirect()->route('files.index')->with('success', 'Le fichier a été supprimé.');
    }
}
