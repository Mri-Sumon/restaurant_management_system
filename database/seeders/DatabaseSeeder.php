<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
use App\Models\AboutPage;
use App\Models\CateringDesp;
use App\Models\CocktailDesp;
use App\Models\CompanyProfile;
use Illuminate\Database\Seeder;
use App\Models\SpecialtieBanner;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $company = CompanyProfile::first();
        if(empty($company)) {
            CompanyProfile::create([
                'name'     => 'Cha Chai Restaurant',
                'title'    => 'Cha Chai Restaurant',
                'phone'    => '019########',
                'email'    => 'chachai@gmail.com',
                'last_update_ip' => request()->ip(),
            ]);
        }

        $user = User::where('code', 'U00001')->first();
        if(empty($user)) {
            User::create([
                'code'     => 'U00001',
                'name'     => 'Admin',
                'username' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make(1),
                'phone'    => '019########',
                'role'     => 'Superadmin',
                'last_update_ip' => request()->ip(),
            ]);
        }

        $categoryCount = Category::count();
        if($categoryCount < 0) {
            Category::insert([
                [
                    'name'           => 'Ac',
                    'slug'           => 'ac',
                    'status'         => 'a',
                    'added_by'       => 1,
                    'created_at'     => Carbon::now(),
                    'last_update_ip' => request()->ip(),
                ],
                [
                    'name'           => 'Non Ac',
                    'slug'           => 'non-ac',
                    'status'         => 'a',
                    'added_by'       => 1,
                    'created_at'     => Carbon::now(),
                    'last_update_ip' => request()->ip(),
                ]
            ]);
        }

        $about =  AboutPage::first();
        if(empty($about)) {
            AboutPage::create([
                'title' => 'Welcome To Cha Chai Restaurant',
                'short_description' => 'test description here',
                'description' => '<p>test description here</p>',
                'status' => 'a',
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'last_update_ip' => request()->ip(),
            ]);
        }

        $cocktail = CocktailDesp::first();
        if(empty($cocktail)) {
            CocktailDesp::create([
                'description' => '<p>cocktails description here</p>',
                'cocktail_image' => 'noImage.gif',
                'cocktail_video' => 'noImage.gif',
            ]);
        }

        $catering = CateringDesp::first();
        if(empty($catering)) {
            CateringDesp::create([
                'title' => 'title here',
                'description' => '<p>Catering description here</p>'
            ]);
        }


        $specialtie = SpecialtieBanner::first();
        if(empty($specialtie)) {
            SpecialtieBanner::create([
                'image' => 'noImage.gif'
            ]);
        }

        $this->call(TermsAndConditionSeeder::class);
        $this->call(PrivacyPolicySeeder::class);
        $this->call(FrontendBgImageSeeder::class);
    }
}
