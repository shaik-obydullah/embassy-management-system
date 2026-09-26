<?php

namespace Database\Seeders;

use App\Models\EmbassyCitizen;
use App\Models\User;
use App\Models\EmbassyArea;
use App\Models\EmbassyOccupation;
use Illuminate\Database\Seeder;

class CitizenSeeder extends Seeder
{
    public function run(): void
    {
        $john = User::where('email', 'client@embassy.com')->first();
        $jane = User::where('email', 'jane@embassy.com')->first();

        $lisbon = EmbassyArea::where('name', 'Lisbon')->first();
        $porto = EmbassyArea::where('name', 'Porto')->first();

        $engineer = EmbassyOccupation::where('name', 'Engineer')->first();
        $doctor = EmbassyOccupation::where('name', 'Doctor')->first();

        EmbassyCitizen::firstOrCreate(
            ['user_id' => $john->id],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'passport_number' => 'N1234567',
                'residence_card_number' => 'PT-12345',
                'area_id' => $lisbon->id,
                'occupation_id' => $engineer->id,
                'date_of_birth' => '1990-05-15',
                'gender' => 'male',
                'phone' => '+351912345678',
                'email' => 'client@embassy.com',
                'address' => 'Rua Augusta 100, Lisbon, Portugal',
            ]
        );

        EmbassyCitizen::firstOrCreate(
            ['user_id' => $jane->id],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'passport_number' => 'N7654321',
                'residence_card_number' => 'PT-67890',
                'area_id' => $porto->id,
                'occupation_id' => $doctor->id,
                'date_of_birth' => '1988-11-22',
                'gender' => 'female',
                'phone' => '+351987654321',
                'email' => 'jane@embassy.com',
                'address' => 'Rua de Santa Catarina 200, Porto, Portugal',
            ]
        );
    }
}
