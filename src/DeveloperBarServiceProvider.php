<?php

declare(strict_types=1);

namespace Componist\DeveloperBar;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class DeveloperBarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'../../config/name.php', 'name');

        

        

        

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'developer-bar');

        // Livewire::component('dynamic-api.index', Index::class);

    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('middlewareName', MiddlewareClass::class);

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            //$schedule->command('command:autoClearSystem')->dailyAt('01:00');

            // for development and testing
            // $schedule->command('command:autoClearSystem')->everyMinute();
        });

        

        // blade componente
        $this->bootBladeComponents();

        // livewire componente
        $this->bootLivewireComponents();

    }

    private function bootBladeComponents(): void
    {
        foreach (config('name.components', []) as $alias => $component) {
            Blade::component(config('name.prefix').$alias, $component);
        }
    }

    private function bootLivewireComponents(): void
    {
        foreach (config('name.livewire', []) as $alias => $component) {
            Livewire::component(config('name.prefix').$alias, $component);
        }
    }


}