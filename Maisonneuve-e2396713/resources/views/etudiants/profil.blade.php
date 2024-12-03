@extends('layout')

@section('title', 'Mon Profil')

@section('content')
<div class="container mt-5">

    <h1>{{ $etudiant->nom }}</h1> 

    <div class="row">
        <div class="col-md-12">
            <ul>

                <li><strong>{{ __('messages.phone') }} :</strong> {{ $etudiant->telephone }}</li>
                <li><strong>{{ __('messages.address') }} :</strong> {{ $etudiant->adresse }}</li>
                <li><strong>{{ __('messages.birth_date') }} :</strong> {{ $etudiant->date_naissance }}</li>
                <li><strong>{{ __('messages.ville') }} :</strong> {{ $etudiant->ville->nom }}</li> 
            </ul>
        </div>
    </div>


</div>
@endsection
