<?php

namespace Database\Seeders;

use App\Models\EmbassyArea;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            ['name' => 'Lisbon'],
            ['name' => 'Porto'],
            ['name' => 'Faro'],
            ['name' => 'Braga'],
            ['name' => 'Coimbra'],
            ['name' => 'Setubal'],
            ['name' => 'Aveiro'],
            ['name' => 'Leiria'],
            ['name' => 'Viseu'],
            ['name' => 'Guimaraes'],
            ['name' => 'Funchal'],
            ['name' => 'Ponta Delgada'],
            ['name' => 'Santarem'],
            ['name' => 'Evora'],
            ['name' => 'Beja'],
            ['name' => 'Portalegre'],
            ['name' => 'Viana do Castelo'],
            ['name' => 'Vila Real'],
            ['name' => 'Braganca'],
            ['name' => 'Castelo Branco'],
            ['name' => 'Guarda'],
        ];

        foreach ($areas as $area) {
            EmbassyArea::firstOrCreate($area);
        }
    }
}
