<?php

declare(strict_types=1);

namespace Componist\DeveloperBar\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComponistDeveloperBarMiddleware
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! config('developer-bar.enabled', false)
            || ! app()->environment('local')
            || ! config('app.debug')) {
            return $response;
        }

        if (! $response instanceof \Illuminate\Http\Response) {
            return $response;
        }

        $contentType = (string) $response->headers->get('Content-Type', '');
        if (! str_contains($contentType, 'text/html')) {
            return $response;
        }

        $content = $response->getContent();
        if ($content === false || $content === '') {
            return $response;
        }

        $devBarInjection = view('developer-bar::componist-developer-bar')->render();

        $manifestPath = __DIR__.'/../../public/build/manifest.json';
        $manifest = is_file($manifestPath)
            ? json_decode((string) file_get_contents($manifestPath), true)
            : null;

        $cssInjection = '';
        $jsInjection = '';

        if (is_array($manifest)) {
            if (isset($manifest['resources/css/developer-bar.css']['file'])) {
                $cssFile = $manifest['resources/css/developer-bar.css']['file'];
                $cssPath = __DIR__.'/../../public/build/'.$cssFile;
                $cssContent = is_file($cssPath) ? file_get_contents($cssPath) : false;
                $cssInjection = is_string($cssContent) && $cssContent !== '' ? "<style>{$cssContent}</style>" : '';
            }

            if (isset($manifest['resources/js/developer-bar.js']['file'])) {
                $jsFile = $manifest['resources/js/developer-bar.js']['file'];
                $jsPath = __DIR__.'/../../public/build/'.$jsFile;
                $jsContent = is_file($jsPath) ? file_get_contents($jsPath) : false;
                $jsInjection = is_string($jsContent) && $jsContent !== '' ? "<script>{$jsContent}</script>" : '';
            }
        }

        if (str_contains($content, '</head>')) {
            $content = str_replace('</head>', $cssInjection.'</head>', $content);
        }

        if (str_contains($content, '</body>')) {
            $content = str_replace('</body>', $devBarInjection.$jsInjection.'</body>', $content);
        }

        $response->setContent($content);

        return $response;
    }
}
