<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenverificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

      $token = $request->cookie('token');

      $result = JWTToken::VerifyToken($token);

      if($result == 'unauthorized'){


        return response()->json([
            'status' => 'Verify failed',
            'message' => 'Unauthorized'
        ], 401);

      }
       else{

        $request->headers->set('email',$result->email);
         return $next($request);


       }

    }
}
