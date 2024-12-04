@extends('layout')

@section('title', 'Liste des Étudiants')

@section('content')
<div class="container mt-5">
    <h1>{{ __('messages.etudiants_list') }}</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach($etudiants as $etudiant)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $etudiant->nom }}</h5>
                    <p class="card-text">
                        <strong>{{ __('messages.adresse') }} :</strong> {{ $etudiant->adresse }} <br>
                        <strong>{{ __('messages.telephone') }} :</strong> {{ $etudiant->telephone }} <br>
                        <strong>{{ __('messages.email') }} :</strong> {{ $etudiant->email }} <br>
                        <strong>{{ __('messages.ville') }} :</strong> {{ $etudiant->ville ? $etudiant->ville->nom : __('Non spécifiée') }}
                    </p>
                    <!-- Bouton pour ouvrir la modal -->
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#etudiantModal{{ $etudiant->id }}">
                        {{ __('messages.view_details') }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Détails, Modifier, Supprimer -->
        <div class="modal fade" id="etudiantModal{{ $etudiant->id }}" tabindex="-1" aria-labelledby="etudiantModalLabel{{ $etudiant->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="etudiantModalLabel{{ $etudiant->id }}">{{ __('messages.modify_or_delete') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulaire de modification -->
                        <form action="{{ route('etudiants.update', $etudiant->id) }}" method="POST">
                            @csrf
                            @method('PUT') 
                        
                            <div class="mb-3">
                                <label for="nom" class="form-label">{{ __('messages.nom') }}</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $etudiant->nom) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label">{{ __('messages.adresse') }}</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $etudiant->adresse) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ville" class="form-label">{{ __('messages.ville') }}</label>
                                <select class="form-select" id="ville" name="ville_id">
                                    @foreach($villes as $ville)
                                        <option value="{{ $ville->id }}" {{ old('ville_id', $etudiant->ville_id) == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="telephone" class="form-label">{{ __('messages.telephone') }}</label>
                                <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $etudiant->telephone) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('messages.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $etudiant->email) }}" required>
                            </div>
                        
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $etudiant->id }}">{{ __('messages.delete') }}</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Supprimer (confirmation) -->
        <div class="modal fade" id="deleteModal{{ $etudiant->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $etudiant->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $etudiant->id }}">{{ __('messages.delete_confirmation') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ __('messages.delete_confirmation') }}
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('messages.delete') }}</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
    
</div>
@endsection
