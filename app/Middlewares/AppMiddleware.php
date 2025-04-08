<?php

namespace App\Middlewares;

use System\Http\Request\Request;
use System\Http\Response\Response;

class AppMiddleware
{
    public function handle(Request $request, \Closure $next): Response
    {
        // do your stuff
        return $next($request);
    }
}
