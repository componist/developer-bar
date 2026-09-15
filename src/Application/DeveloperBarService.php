<?php

declare(strict_types=1);

namespace Componist\DeveloperBar\Application;

use Illuminate\Support\Facades\Artisan;

final class DeveloperBarService
{
    public static function clearApplicationCache(): void
    {
        Artisan::call('optimize:clear');
    }
}
