<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * This middleware can add Authorization's header in our request using the token 
 */
class UpdateAuthorizationHeaderFromToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(isset($request->token) ) {
            $request->headers->add(['Authorization' => 'Bearer ' . $request->token]);
        }

        return $next($request);
    }
}
