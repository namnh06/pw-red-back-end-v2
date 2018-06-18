<?php

namespace App\Http\Controllers\Web\Auth;

use App\Models\Web\User as WebUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $token = null;

        $user = WebUser::where(['userName' => $request->userName,'password' => $request->password])->first();
        if(! $token = JWTAuth::fromUser($user)){
            return response_error([],'Unauthorized',401);
        }

        return response_success([
            'token' => $token
        ],200);
    }

    public function refresh()
    {
        $token = auth()->refresh();

        return response_success([
            'token' => $token
        ]);

    }

    public function logout()
    {
        auth()->logout();

        return response_success([],'Successfully logged out');
    }


}
