<?php

namespace Database\Factories;

use App\Models\Ville;
use Illuminate\Database\Eloquent\Factories\Factory;

class VilleFactory extends Factory
{
    /**
     * Liste des villes du Québec
     *
     * @var array
     */
    private $quebecCities = [
        'Montréal', 'Laval', 'Gatineau', 'Longueuil', 'Sherbrooke', 'Trois-Rivières', 'Lévis',
        'Terrebonne', 'Saguenay', 'Repentigny', 'Brossard', 'Saint-Jérôme',
        'Châteauguay', 'Drummondville',  'Victoriaville' 
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Sélectionner une ville au hasard parmi la liste des villes du Québec
        $city = $this->faker->randomElement($this->quebecCities);

        return [
            'nom' => $city,
        ];
    }
}
