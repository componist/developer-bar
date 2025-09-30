<?php

namespace Componist\DeveloperBar\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComponistDeveloperBarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
         // Nur im Dev-Modus + nur HTML
        if (
            app()->environment('local') &&
            $response instanceof \Illuminate\Http\Response &&
            str_contains($response->headers->get('Content-Type'), 'text/html')
        ) {
            $content = $response->getContent();

            // Developer Bar HTML einfügen
            $devBarInjection = view('developer-bar::componist-developer-bar')->render();
            
            // Assets aus Manifest laden
            $manifestPath = __DIR__ . '/../../public/build/manifest.json';
            $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : null;
            
            $cssInjection = '';
            $jsInjection = '';
            
            if ($manifest) {
                // CSS aus Manifest laden
                if (isset($manifest['resources/css/developer-bar.css']['file'])) {
                    $cssFile = $manifest['resources/css/developer-bar.css']['file'];
                    $cssPath = __DIR__ . '/../../public/build/' . $cssFile;
                    $cssContent = file_exists($cssPath) ? file_get_contents($cssPath) : '';
                    $cssInjection = $cssContent ? "<style>{$cssContent}</style>" : '';
                }
                
                // JavaScript aus Manifest laden
                if (isset($manifest['resources/js/developer-bar.js']['file'])) {
                    $jsFile = $manifest['resources/js/developer-bar.js']['file'];
                    $jsPath = __DIR__ . '/../../public/build/' . $jsFile;
                    $jsContent = file_exists($jsPath) ? file_get_contents($jsPath) : '';
                    $jsInjection = $jsContent ? "<script>{$jsContent}</script>" : '';
                }
            }
            
            // CSS in <head> einfügen
            if (strpos($content, '</head>') !== false) {
                $content = str_replace('</head>', $cssInjection . '</head>', $content);
            }

            // JavaScript und Developer Bar vor </body> einfügen
            if (strpos($content, '</body>') !== false) {
                $content = str_replace('</body>', $devBarInjection . $jsInjection . '</body>', $content);
            }

            $response->setContent($content);
        }

        return $response;
    }
}