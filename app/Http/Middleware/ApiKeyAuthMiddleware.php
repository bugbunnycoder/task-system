<?php

namespace App\Http\Middleware;

use Closure;

class ApiKeyAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('X-Api-Key');

        // Validate the API key
        if ($apiKey !== config('app.api_key')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
