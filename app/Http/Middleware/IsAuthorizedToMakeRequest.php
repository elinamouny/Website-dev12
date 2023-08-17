<?php

namespace App\Http\Middleware;

use App\Exceptions\NonAuthorizedException;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;


/**
 * This middleware is use to check access to some resources in app
 */
class IsAuthorizedToMakeRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if token is set
        $token = '';
        if(isset($request['token']))
            $token = $request->token;
        else if(isset($_SERVER['HTTP_AUTHORIZATION']))
            $token = trim(substr($_SERVER['HTTP_AUTHORIZATION'], 6)); // count(Barear) = 6 
        else
            throw new NonAuthorizedException();
        
        // check if token is valid
        $tokenAccessInstance = PersonalAccessToken::findToken($token);

        if(!is_null($tokenAccessInstance))
            return $next($request);
        else 
            throw new NonAuthorizedException();
    }
}
