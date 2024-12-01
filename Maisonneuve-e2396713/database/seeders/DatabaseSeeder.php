<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Ville;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Créer des villes du Québec
        Ville::factory(15)->create(); 

        // Créer des utilisateurs et des étudiants
        User::factory(100)->create()->each(function ($user) {
            // Pour chaque utilisateur créé, créer un étudiant lié avec le même email
            Etudiant::factory()->create(['user_id' => $user->id, 'email' => $user->email]);
        });
    }
}
