<?php

declare(strict_types=1);

namespace Componist\DeveloperBar\Tests\Feature;

use Componist\DeveloperBar\Middleware\ComponistDeveloperBarMiddleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeveloperBarFeatureTest extends TestCase
{
    public function test_middleware_does_not_modify_response_when_disabled(): void
    {
        config(['developer-bar.enabled' => false]);

        $middleware = new ComponistDeveloperBarMiddleware;
        $request = Request::create('/', 'GET');
        $response = new Response('<html><body>Test</body></html>', 200, [
            'Content-Type' => 'text/html; charset=UTF-8',
        ]);

        $result = $middleware->handle($request, fn () => $response);

        $this->assertSame('<html><body>Test</body></html>', $result->getContent());
    }
}
