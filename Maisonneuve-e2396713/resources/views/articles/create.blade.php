@extends('layout')

@section('title', 'Créer un article')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ __('messages.article') }}</h1>

    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">{{ __('messages.title') }}</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">{{ __('messages.content') }}</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="language" class="form-label">{{ __('messages.language') }}</label>
            <select class="form-control" id="language" name="language" required>
                <option value="fr">Français</option>
                <option value="en">English</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.save_article') }}</button>
    </form>
</div>
@endsection
