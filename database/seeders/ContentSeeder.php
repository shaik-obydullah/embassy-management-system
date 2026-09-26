<?php

namespace Database\Seeders;

use App\Models\EmbassyContent;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@embassy.com')->first();

        $contents = [
            [
                'title' => 'About Embassy',
                'slug' => 'about-embassy',
                'body' => 'The Embassy of the People\'s Republic of Bangladesh in Lisbon serves the Bangladeshi community in Portugal, providing consular services, document legalization, and support to Bangladeshi citizens living or traveling abroad. Our mission is to strengthen the bonds between Bangladesh and its diaspora communities.',
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Visa Requirements',
                'slug' => 'visa-requirements',
                'body' => 'To apply for a visa to Bangladesh, you must submit the following documents: a completed visa application form, a valid passport with at least 6 months validity, two recent passport-sized photos, proof of accommodation, proof of financial means, and travel insurance. Processing times vary depending on the visa type.',
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Embassy Hours',
                'slug' => 'embassy-hours',
                'body' => 'The embassy is open from Monday to Friday, 9:00 AM to 5:00 PM. Consular services are available from 9:00 AM to 1:00 PM. The embassy is closed on Bangladeshi and Portuguese public holidays. Appointments are recommended for all consular services.',
                'is_published' => true,
                'created_by' => $admin->id,
            ],
        ];

        foreach ($contents as $content) {
            EmbassyContent::firstOrCreate(
                ['slug' => $content['slug']],
                $content
            );
        }
    }
}
