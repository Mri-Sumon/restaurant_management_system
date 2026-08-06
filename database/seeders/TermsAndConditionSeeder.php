<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TermsAndCondition;

class TermsAndConditionSeeder extends Seeder
{
    public function run()
    {
        TermsAndCondition::create([
            'title' => 'Terms and Conditions Example 1',
            'description' => 'This is an example of the terms and conditions description for the first entry.',
        ]);

        TermsAndCondition::create([
            'title' => 'Terms and Conditions Example 2',
            'description' => 'This is an example of the terms and conditions description for the second entry.',
        ]);
    }
}
