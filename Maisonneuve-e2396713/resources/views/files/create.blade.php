
@extends('layout')

@section('title', 'Ajouter un fichier')

@section('content')
<div class="container mt-5">
    <h1>{{ __('Ajouter un fichier') }}</h1>

    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title_fr" class="form-label">{{ __('Titre en français') }}</label>
            <input type="text" class="form-control" id="title_fr" name="title_fr" required>
        </div>

        <div class="mb-3">
            <label for="title_en" class="form-label">{{ __('Titre en anglais') }}</label>
            <input type="text" class="form-control" id="title_en" name="title_en" required>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">{{ __('Fichier') }}</label>
            <input type="file" class="form-control" id="file" name="file" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Ajouter le fichier') }}</button>
    </form>
</div>
@endsection
