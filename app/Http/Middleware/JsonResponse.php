<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use View;

class JsonResponse
{
    public function handle(Request $request, Closure $next) {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
