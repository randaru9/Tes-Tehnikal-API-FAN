<?php

namespace App\Http\Middleware;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Response as HelpersResponse;
use Illuminate\Http\Request;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class APIAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {

            $payload = JWTAuth::parseToken(JWTAuth::getToken())->getPayload();
            
            if (isset($payload['sub'])) {
                $user = User::firstWhere('id', $payload['sub']);

                if ($user !== null) {
                    return $next($request);
                }
            }

            throw new \Exception();
        } catch (\Exception $e) {
            return HelpersResponse::SetAndGet(HelpersResponse::UNAUTHORIZED, 'Anda tidak memiliki akses');
        }

    }
}
