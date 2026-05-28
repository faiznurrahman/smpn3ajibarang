<?php

namespace App\Http\Middleware;

use App\Models\WebsiteVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackWebsiteVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track successful GET requests (not AJAX, not Livewire)
        if (
            $request->isMethod('GET')
            && ! $request->ajax()
            && ! $request->hasHeader('X-Livewire')
            && $response->isSuccessful()
        ) {
            $routeName = $request->route()?->getName() ?? 'unknown';
            $sessionKey = 'wv_' . now()->toDateString() . '_' . $routeName;

            // Count once per session per page per day
            if (! session()->has($sessionKey)) {
                session()->put($sessionKey, true);
                WebsiteVisit::create([
                    'halaman'    => $routeName,
                    'ip_address' => $request->ip(),
                    'created_at' => now(),
                ]);
            }
        }

        return $response;
    }
}
