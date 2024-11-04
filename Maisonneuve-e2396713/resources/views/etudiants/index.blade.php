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
                    <div class="text-end">
                        <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-warning">Modifier</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
