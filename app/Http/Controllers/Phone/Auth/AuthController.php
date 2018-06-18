<?php

namespace App\Http\Controllers\Phone\Auth;

use App\Models\Web\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class AuthController extends Controller
{
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function login(Request $request)
    {
        $token = null;

        $user = User::where(['userName' => $request->userName,'password' => $request->password])->first();
        if(! $token = JWTAuth::fromUser($user)){
            return response_error([],'Unauthorized',401);
        }
        return response()->json(
            [
                'token' =>$token
            ],200);
    }

    public function refresh()
    {
        $token = auth()->refresh();

        return response_success([
            'token' => $token
        ]);

    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function logout()
    {
        auth()->logout();

        return response_success([],'Successfully logged out');
    }


}
