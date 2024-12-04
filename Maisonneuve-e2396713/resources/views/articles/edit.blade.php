@extends('layout')

@section('title', 'Modifier l\'article')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ __('messages.update_article') }} </h1>

    <form action="{{ route('articles.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="title" class="form-label">{{ __('messages.title') }}</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">{{ __('messages.content') }}</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $article->content }}</textarea>
        </div>

        <div class="mb-3">
            <label for="language" class="form-label">{{ __('messages.langue')}}</label>
            <select class="form-control" id="language" name="language" required>
                <option value="fr" {{ $article->language == 'fr' ? 'selected' : '' }}>Français</option>
                <option value="en" {{ $article->language == 'en' ? 'selected' : '' }}>English</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.update_article') }}</button>
    </form>
</div>
@endsection
