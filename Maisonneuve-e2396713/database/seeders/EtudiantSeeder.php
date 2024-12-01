<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Etudiant;

class EtudiantSeeder extends Seeder
{
    public function run()
    {
        // Créer 100 étudiants avec des données aléatoires
        \App\Models\Etudiant::factory(100)->create();
    }
}
