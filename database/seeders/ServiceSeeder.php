<?php

namespace Database\Seeders;

use App\Models\EmbassyService;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'New Passport Application',
                'slug' => 'new-passport-application',
                'category' => 'passport',
                'description' => 'Apply for a new passport for first-time applicants.',
                'fee' => 80.00,
                'estimated_days' => 15,
                'required_documents' => ['Original birth certificate', 'National ID card', 'Two recent passport-sized photos', 'Proof of residence'],
            ],
            [
                'name' => 'Passport Renewal',
                'slug' => 'passport-renewal',
                'category' => 'passport',
                'description' => 'Renew an existing passport that is about to expire or has expired.',
                'fee' => 70.00,
                'estimated_days' => 10,
                'required_documents' => ['Current passport', 'Two recent passport-sized photos', 'Proof of residence'],
            ],
            [
                'name' => 'Passport Replacement',
                'slug' => 'passport-replacement',
                'category' => 'passport',
                'description' => 'Replace a lost, stolen, or damaged passport.',
                'fee' => 90.00,
                'estimated_days' => 20,
                'required_documents' => ['Police report (if stolen)', 'Original birth certificate', 'National ID card', 'Two recent passport-sized photos', 'Proof of residence'],
            ],
            [
                'name' => 'Visa Application - Tourist',
                'slug' => 'visa-application-tourist',
                'category' => 'visa',
                'description' => 'Apply for a tourist visa to visit Portugal.',
                'fee' => 60.00,
                'estimated_days' => 7,
                'required_documents' => ['Completed visa application form', 'Valid passport', 'Two recent passport-sized photos', 'Flight itinerary', 'Hotel reservation', 'Proof of financial means'],
            ],
            [
                'name' => 'Visa Application - Business',
                'slug' => 'visa-application-business',
                'category' => 'visa',
                'description' => 'Apply for a business visa for professional activities.',
                'fee' => 100.00,
                'estimated_days' => 5,
                'required_documents' => ['Completed visa application form', 'Valid passport', 'Two recent passport-sized photos', 'Invitation letter from Portuguese company', 'Proof of business registration', 'Flight itinerary'],
            ],
            [
                'name' => 'Attestation',
                'slug' => 'attestation',
                'category' => 'consular',
                'description' => 'Attestation of documents for official use.',
                'fee' => 30.00,
                'estimated_days' => 3,
                'required_documents' => ['Original document', 'Photocopy of document', 'Valid ID'],
            ],
            [
                'name' => 'Power of Attorney',
                'slug' => 'power-of-attorney',
                'category' => 'consular',
                'description' => 'Draft and notarize a power of attorney document.',
                'fee' => 40.00,
                'estimated_days' => 2,
                'required_documents' => ['Valid ID of grantor', 'Valid ID of grantee', 'Draft of power of attorney'],
            ],
            [
                'name' => 'Birth Registration',
                'slug' => 'birth-registration',
                'category' => 'registration',
                'description' => 'Register a birth at the embassy.',
                'fee' => 20.00,
                'estimated_days' => 5,
                'required_documents' => ['Hospital birth certificate', 'Parents marriage certificate', 'Parents ID documents'],
            ],
            [
                'name' => 'Marriage Registration',
                'slug' => 'marriage-registration',
                'category' => 'registration',
                'description' => 'Register a marriage at the embassy.',
                'fee' => 25.00,
                'estimated_days' => 5,
                'required_documents' => ['Marriage certificate', 'Both spouses ID documents', 'Two witnesses ID documents'],
            ],
            [
                'name' => 'NID Card Application',
                'slug' => 'nid-card-application',
                'category' => 'other',
                'description' => 'Apply for a National Identification (NID) card.',
                'fee' => 15.00,
                'estimated_days' => 10,
                'required_documents' => ['Original birth certificate', 'Two recent passport-sized photos', 'Proof of residence'],
            ],
        ];

        foreach ($services as $service) {
            EmbassyService::firstOrCreate(
                ['slug' => $service['slug']],
                $service
            );
        }
    }
}
