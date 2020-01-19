<?php

namespace SPDP\Http\Controllers\Auth\API;

use SPDP\User;
use SPDP\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($credentials)) {
            return response()->json(['error' => 'Wrong email and password'], 401);
        }
        $user = User::where('email', $credentials['email'])->first();
        $token = $user->createToken('auth_token')->accessToken;
        return response()->json(['user' => $user, 'access_token' => $token], 200);
        // return response()->json(auth()->user());
    }
    
    public function showLoginPage(Request $request)
    {
        return view('auth.login');
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
}
