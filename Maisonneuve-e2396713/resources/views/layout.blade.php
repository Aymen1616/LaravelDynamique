<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Liens vers Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', 'Page d\'Accueil')</title>


</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">Collège Maisonneuve</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('etudiants.index') }}">Liste des Étudiants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('etudiants.create') }}">Ajouter un Étudiant</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        @yield('content') <!-- Contenu spécifique à chaque page -->

        @if(Request::is('/')) <!-- Condition pour vérifier si nous sommes sur la page d'accueil -->
            <div class="row mt-5">
                <!-- Carte 1 : Liste des étudiants -->
                <div class="col-md-6 mb-4">
                    <a href="{{ route('etudiants.index') }}" class="card-link">
                        <div class="card">
                            <img src="{{ asset('images/liste_etudiants.jfif') }}" class="card-img-top" alt="Liste des étudiants">
                            <div class="card-body text-center">
                                <h5 class="card-title">Liste des Étudiants</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Carte 2 : Ajouter un étudiant -->
                <div class="col-md-6 mb-4">
                    <a href="{{ route('etudiants.create') }}" class="card-link">
                        <div class="card">
                            <img src="{{ asset('images/ajouter_etudiant.jfif') }}" class="card-img-top" alt="Ajouter un étudiant">
                            <div class="card-body text-center">
                                <h5 class="card-title">Ajouter un Étudiant</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif
    </main>

    <footer class="text-center mt-4">
        <p>&copy; {{ date('Y') }} Mon Application. Tous droits réservés.</p>
    </footer>

    <!-- Liens vers Bootstrap 5 JavaScript (inclus Popper et Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
