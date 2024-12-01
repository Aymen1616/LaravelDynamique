<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ville;

class VilleSeeder extends Seeder
{
    public function run()
    {
        $villes = [
            'Montréal', 'Québec', 'Trois-Rivières', 'Sherbrooke', 'Laval',
            'Gatineau', 'Longueuil', 'Chicoutimi', 'Lévis', 'Bromont',
            'Saguenay', 'Drummondville', 'Saint-Jérôme', 'Granby', 'Saint-Hyacinthe'
        ];

        foreach ($villes as $ville) {
            Ville::create(['nom' => $ville]);
        }
    }
}
