<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class LoginController extends Controller
{

    public function action(LoginRequest $request): JsonResponse
    {
        [
            'password' => $password,
            'email' => $email,
        ] = $request;

        $user = User::firstWhere('email', $email);

        $response = new Response();

        if ($user !== null && Hash::check($password, $user->password)) {

            $ttl = config('jwt.ttl');

            $payload = JWTFactory::setTTL($ttl)->customClaims(['sub' => $user->id])->make();

            $exp = Carbon::createFromTimestamp($payload->get('exp'), config('app.timezone'));

            $data = [
                'token' => JWTAuth::encode($payload)->get(),
                'exp' => $exp,
            ];

            $response->set(Response::OK, 'Login berhasil', $data);

        }else{

            $response->set(Response::UNAUTHORIZED, 'Login gagal', null);
        
        }

        return $response->get();

    }
}
