<?php

declare(strict_types=1);

namespace Componist\DeveloperBar;

use Livewire\Livewire;
use Illuminate\Routing\Router;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Componist\DeveloperBar\Livewire\ComponistDeveloperBar;
use Componist\DeveloperBar\Middleware\ComponistDeveloperBarMiddleware;

class DeveloperBarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'developer-bar');

        Livewire::component('componist-developer-bar', ComponistDeveloperBar::class);
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('web', ComponistDeveloperBarMiddleware::class);
    }
}