<?php

namespace Database\Seeders;

use App\Models\EmbassyOccupation;
use Illuminate\Database\Seeder;

class OccupationSeeder extends Seeder
{
    public function run(): void
    {
        $occupations = [
            ['name' => 'Engineer'],
            ['name' => 'Doctor'],
            ['name' => 'Teacher'],
            ['name' => 'Driver'],
            ['name' => 'Businessman'],
            ['name' => 'Student'],
            ['name' => 'Worker'],
            ['name' => 'Nurse'],
            ['name' => 'Accountant'],
            ['name' => 'Architect'],
            ['name' => 'Lawyer'],
            ['name' => 'Pharmacist'],
            ['name' => 'Journalist'],
            ['name' => 'Government Employee'],
            ['name' => 'Other'],
        ];

        foreach ($occupations as $occupation) {
            EmbassyOccupation::firstOrCreate($occupation);
        }
    }
}
