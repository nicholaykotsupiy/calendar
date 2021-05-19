<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __invoke(Request $request)
    {
//        return response()->json($request);

        $userApi = $request;

//        return response()->json($userApi);

        $user = User::whereEmail($userApi->email)->first();

        if(! $user)
        {
            $userDB = new User();

            $userDB->name = $userApi->name . $userApi->surname;
            $userDB->email = $userApi->email;

            $userDB->save();

            return response()->json($userDB, 200);
        }

        return response()->json($user, 200);
    }
}
