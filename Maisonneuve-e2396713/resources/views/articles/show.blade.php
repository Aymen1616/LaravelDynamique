@extends('layout')

@section('title', $article->title)

@section('content')
<div class="container">
    <h1 class="mb-4">{{ $article->title }}</h1>
    <p>{{ $article->content }}</p>

    <p><small>{{__('messages.add_article')}} : {{ $article->user->name }} le {{ $article->created_at->format('d/m/Y') }}</small></p>

    @if(auth()->check() && auth()->user()->id === $article->user_id)
        <!-- Option de modification -->
        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">{{__('messages.update_article')}}</a>

        <!-- Option de suppression -->
        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">{{__(messages.delete)}}</button>
        </form>
    @endif
</div>
@endsection
