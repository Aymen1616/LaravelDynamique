@extends('layout')

@section('title', 'Liste des Étudiants')

@section('content')
<div class="container mt-5">
    <h1>Liste des Étudiants</h1>

    <!-- Affichage des messages de succès et d'erreur -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        @foreach($etudiants as $etudiant)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $etudiant->nom }}</h5>
                    <p class="card-text">
                        <strong>Adresse :</strong> {{ $etudiant->adresse }} <br>
                        <strong>Téléphone :</strong> {{ $etudiant->telephone }} <br>
                        <strong>Email :</strong> {{ $etudiant->email }} <br>
                        <strong>Date de Naissance :</strong> {{ $etudiant->date_naissance }} <br>
                        <strong>Ville :</strong> {{ $etudiant->ville ? $etudiant->ville->nom : 'Non spécifiée' }}
                    </p>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#etudiantModal{{ $etudiant->id }}">
                        Voir Détails
                    </button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="etudiantModal{{ $etudiant->id }}" tabindex="-1" aria-labelledby="etudiantModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="etudiantModalLabel">Détails de l'Étudiant</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nom :</strong> {{ $etudiant->nom }}</p>
                        <p><strong>Adresse :</strong> {{ $etudiant->adresse }}</p>
                        <p><strong>Téléphone :</strong> {{ $etudiant->telephone }}</p>
                        <p><strong>Email :</strong> {{ $etudiant->email }}</p>
                        <p><strong>Date de Naissance :</strong> {{ $etudiant->date_naissance }}</p>
                        <p><strong>Ville :</strong> {{ $etudiant->ville->nom ?? 'Non spécifiée' }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
