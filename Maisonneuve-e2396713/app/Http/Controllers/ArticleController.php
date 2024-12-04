<?php


namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Afficher tous les articles
    public function index()
{
    $articles = Article::paginate(10);  
    return view('articles.index', compact('articles'));
}

    // Afficher le formulaire pour créer un nouvel article
    public function create()
    {
        return view('articles.create');
    }

    // Stocker un nouvel article
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'language' => 'required|in:fr,en',
        ]);
    
        // Créez l'article avec les données validées
        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'language' => $request->language,
        ]);
    
        return redirect()->route('articles.index')->with('success', 'Article créé avec succès');
    }
    

    // Afficher un article
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    // Afficher le formulaire pour éditer un article
    public function edit(Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            return redirect()->route('articles.index')->with('error', 'Vous ne pouvez pas modifier cet article.');
        }

        return view('articles.edit', compact('article'));
    }

    // Mettre à jour un article
    public function update(Request $request, Article $article)
    {
        // Vérifier si l'article appartient à l'utilisateur connecté
        if ($article->user_id !== Auth::id()) {
            return redirect()->route('articles.index')->with('error', 'Vous ne pouvez pas modifier cet article.');
        }
    
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'language' => 'required|in:fr,en',
        ]);
    
        // Mettre à jour l'article
        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'language' => $request->language,
        ]);
    
        // Redirection vers la liste des articles avec un message de succès
        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès');
    }
    

    // Supprimer un article
    public function destroy(Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            return redirect()->route('articles.index')->with('error', 'Vous ne pouvez pas supprimer cet article.');
        }

        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès');
    }
}

