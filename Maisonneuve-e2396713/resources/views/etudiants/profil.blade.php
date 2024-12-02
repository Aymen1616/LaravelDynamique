@extends('layout')

@section('title', 'Mon Profil')

@section('content')
<div class="container mt-5">
    <!-- Affichage du nom de l'étudiant dans le titre -->
    <h1>{{ $etudiant->nom }}</h1> <!-- Le nom de l'étudiant dans le titre -->

    <div class="row">
        <div class="col-md-12">
            <ul>

                <li><strong>Téléphone :</strong> {{ $etudiant->telephone }}</li>
                <li><strong>Adresse :</strong> {{ $etudiant->adresse }}</li>
                <li><strong>Date de naissance :</strong> {{ $etudiant->date_naissance }}</li>
                <li><strong>Ville :</strong> {{ $etudiant->ville->nom }}</li> <!-- Si vous avez une relation 'ville' -->
            </ul>
        </div>
    </div>


</div>
@endsection
