<?php

namespace App\Providers;

use App\Models\SubTreatment;
use App\Models\Treatment;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        // Menggunakan View::share() untuk mengirimkan data ke semua view
        $treatments = Treatment::all();
        $subtreatments = SubTreatment::all();
        View::share('treatments', $treatments);
        View::share('subtreatments', $subtreatments);
    }
}