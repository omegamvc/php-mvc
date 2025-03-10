<?php

declare(strict_types=1);

namespace App\Middlewares;

use Closure;
use System\Http\Request;
use System\Http\Response;

class AppMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // do your stuff
        return $next($request);
    }
}
