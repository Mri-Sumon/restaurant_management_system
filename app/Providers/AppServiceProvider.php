<?php

namespace App\Providers;

use App\Models\Slider;
use App\Models\Shortcut;
use App\Models\AboutPage;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $info = CompanyProfile::first();
        $about = AboutPage::first();
        $sliders = Slider::where('status', 'a')->latest()->get();

        view()->share([
            'sliders' => $sliders,
            'about' => $about,
            'info' => $info,
            'company' => $info,
        ]);

    }

}
