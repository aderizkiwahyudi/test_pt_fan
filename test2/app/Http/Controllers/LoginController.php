<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
            $user = $user->where('email', $request->email)->firstOrFail();
            $user->token = $user->createToken('auth')->plainTextToken;
            return new LoginResource($user);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
