<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __invoke(Request $request)
    {
        $userApi = json_encode($request->user);
        $takenApi = json_encode($request->token);

        $user = User::whereEmail(json_decode($userApi)->email)->first();

        if(! $user)
        {
            $userDB = new User();

            $userDB->name = json_decode($userApi)->name . ' '. json_decode($userApi)->surname;
            $userDB->email = json_decode($userApi)->email;
            $userDB->access_token = json_decode($takenApi);

            $userDB->save();

            return response()->json($userDB, 200);
        }

        $user->access_token = json_decode($takenApi);

        $user->save();

        return response()->json($user, 200);
    }
}
