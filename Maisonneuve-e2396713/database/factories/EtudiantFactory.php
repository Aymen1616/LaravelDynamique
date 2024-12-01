<?php

namespace Database\Factories;

use App\Models\Etudiant;
use App\Models\Ville;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Créer un utilisateur
        $user = User::factory()->create();

        // Récupérer une ville du Québec aléatoirement
        $ville = Ville::inRandomOrder()->first();

        return [
            'nom' => $this->faker->name,
            'adresse' => $this->faker->address,
            'telephone' => $this->faker->phoneNumber,
            'email' => $user->email, 
            'date_naissance' => $this->faker->date,
            'ville_id' => $ville->id, 
            'user_id' => $user->id, 
        ];
    }
}
