<?php

declare(strict_types=1);

namespace Componist\DeveloperBar\Tests\Unit\Application;

use Componist\DeveloperBar\Application\DeveloperBarService;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class DeveloperBarServiceTest extends TestCase
{
    public function test_clear_application_cache_runs_optimize_clear(): void
    {
        $called = false;

        Artisan::shouldReceive('call')
            ->once()
            ->with('optimize:clear')
            ->andReturnUsing(function () use (&$called): int {
                $called = true;

                return 0;
            });

        DeveloperBarService::clearApplicationCache();

        $this->assertTrue($called);
    }
}
