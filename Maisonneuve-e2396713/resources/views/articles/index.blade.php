@extends('layout')

@section('title', 'Liste des articles')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des articles</h1>

    <!-- Affichage du message de succès -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Affichage du message d'erreur -->
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Affichage des articles sous forme de cartes -->
    <div class="row">
        @foreach($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                        </h5>
                        <p class="card-text">{{ Str::limit($article->content, 150) }}...</p>
                        <p><small>Langue: {{ $article->language }}</small></p>

                        <!-- Si l'utilisateur est le propriétaire de l'article, lui permettre de le modifier ou supprimer -->
                        @if($article->user_id == Auth::id())
                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination des articles -->
    {{ $articles->links() }}

    <!-- Bouton pour créer un nouvel article -->
    <a href="{{ route('articles.create') }}" class="btn btn-primary mt-3">Créer un nouvel article</a>
</div>
@endsection
