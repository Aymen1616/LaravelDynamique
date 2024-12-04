@extends('layout')

@section('title', 'Modifier un fichier')

@section('content')
<div class="container mt-5">
    <h1>{{ __('messages.edit_file') }}</h1>

    <!-- Affichage des messages d'erreur et de succès -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('files.update', $file->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Indiquer que la méthode est PUT pour la mise à jour -->
        
        <!-- Titre en Français -->
        <div class="mb-3">
            <label for="title_fr" class="form-label">{{ __('messages.title_fr') }}</label>
            <input type="text" class="form-control" id="title_fr" name="title_fr" value="{{ old('title_fr', $file->title_fr) }}" required>
        </div>

        <!-- Titre en Anglais -->
        <div class="mb-3">
            <label for="title_en" class="form-label">{{ __('messages.title_en') }}</label>
            <input type="text" class="form-control" id="title_en" name="title_en" value="{{ old('title_en', $file->title_en) }}" required>
        </div>

        <!-- Télécharger un nouveau fichier -->
        <div class="mb-3">
            <label for="file" class="form-label">{{ __('messages.file') }}</label>
            <input type="file" class="form-control" id="file" name="file">
            <small class="form-text text-muted">{{ __('messages.optional') }}</small>
        </div>

        <!-- Afficher le fichier actuel -->
        <div class="mb-3">
            <label class="form-label">{{ __('messages.current_file') }}</label>
            <a href="{{ Storage::url($file->path) }}" target="_blank">{{ __('messages.view_current_file') }}</a>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
    </form>
</div>
@endsection
