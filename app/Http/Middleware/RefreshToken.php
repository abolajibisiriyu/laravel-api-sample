<?php

namespace App\Http\Middleware;

use Closure;

use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;

use JWTAuth;

class RefreshToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        return $next($request);
        $response = $next($request);

        try {

             JWTAuth::parseToken()->authenticate();

        } catch (TokenExpiredException $e) {

            $newToken = JWTAuth::parseToken()->refresh();
            $response->headers->set('Authorization', 'Bearer '.$newToken);

        }catch (JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
        return $response;
    }
}
