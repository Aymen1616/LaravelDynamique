<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Liens vers Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Liens vers Font Awesome (pour l'icône) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', 'Page d\'Accueil')</title>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="/">
                    <i class="fas fa-school me-2"></i>
                    Collège Maisonneuve
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNav">
                    <ul class="navbar-nav d-flex justify-content-center">
                        <li class="nav-item ms-4">
                            <a class="nav-link" href="{{ route('etudiants.index') }}">{{ __('messages.student_list') }}</a>
                        </li>
                        <li class="nav-item ms-4">
                            <a class="nav-link" href="{{ url('/articles') }}">Forum</a>
                        </li>
                        <li class="nav-item ms-4">
                            <a class="nav-link" href="{{ route('profil') }}">{{ __('messages.profile') }}</a>
                        </li>
                        @if (auth()->check())
                            <li class="nav-item ms-4">
                                <a class="nav-link" href="{{ route('logout') }}">{{ __('messages.logout') }}</a>
                            </li>
                        @else
                            <li class="nav-item ms-4">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                            </li>
                        @endif
                        <!-- Ajout du lien vers l'index des fichiers -->
                        <li class="nav-item ms-4">
                            <a class="nav-link" href="{{ route('files.index') }}">{{ __('messages.files') }}</a>
                        </li>
                        <li class="nav-item dropdown ms-4">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ app()->getLocale() }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('lang', ['locale' => 'en']) }}">English</a></li>
                                <li><a class="dropdown-item" href="{{ route('lang', ['locale' => 'fr']) }}">Français</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
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
                                <h5 class="card-title">{{ __('messages.student_list') }}</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Carte 2 : Ajouter un étudiant -->
                <div class="col-md-6 mb-4">
                    <a href="{{ route('auth.register') }}" class="card-link">
                        <div class="card">
                            <img src="{{ asset('images/ajouter_etudiant.jfif') }}" class="card-img-top" alt="Ajouter un étudiant">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ __('messages.inscription_etudiant') }}</h5>
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
