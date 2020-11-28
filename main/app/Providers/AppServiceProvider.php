<?php

namespace App\Providers;

use App\Categoria;
use App\Macroproceso;
use App\Observers\CategoriaObserver;
use App\Observers\MacroprocesoObserver;
use App\Observers\ProcesoObserver;
use App\Observers\SubprocesoObserver;
use App\Proceso;
use App\Subproceso;
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
        Macroproceso::observe(MacroprocesoObserver::class);
        Proceso::observe(ProcesoObserver::class);
        Subproceso::observe(SubprocesoObserver::class);
        Categoria::observe(CategoriaObserver::class);
    }
}
