<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrivacyPolicy;

class PrivacyPolicySeeder extends Seeder
{
    public function run()
    {
        PrivacyPolicy::create([
            'title' => 'Privacy Policy Title 1',
            'description' => 'This is the description for the first privacy policy.',
        ]);

        PrivacyPolicy::create([
            'title' => 'Privacy Policy Title 2',
            'description' => 'This is the description for the second privacy policy.',
        ]);
    }
}
