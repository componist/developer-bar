<?php

declare(strict_types=1);

namespace Componist\DeveloperBar;

use Componist\DeveloperBar\Livewire\ComponistDeveloperBar;
use Componist\DeveloperBar\Middleware\ComponistDeveloperBarMiddleware;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class DeveloperBarServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/developer-bar.php', 'developer-bar');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'developer-bar');

        Livewire::component('componist-developer-bar', ComponistDeveloperBar::class);
    }

    public function boot(): void
    {
        if (! $this->shouldRegisterMiddleware()) {
            return;
        }

        $this->app['router']->pushMiddlewareToGroup('web', ComponistDeveloperBarMiddleware::class);
    }

    private function shouldRegisterMiddleware(): bool
    {
        if (! config('developer-bar.enabled', false)) {
            return false;
        }

        return $this->app->environment('local') && (bool) config('app.debug');
    }
}
