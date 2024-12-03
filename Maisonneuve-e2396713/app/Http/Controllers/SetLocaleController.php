<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetLocaleController extends Controller
{
    public function index($locale)
    {
        if (! in_array($locale, ['en', 'fr'])) {
            abort(400); // Langue invalide
        }

        // Stocke la langue dans la session
        session()->put('locale', $locale);

        // Définit la langue de l'application
        app()->setLocale($locale);

        // Redirige vers la page précédente
        return redirect()->back();
    }
}
