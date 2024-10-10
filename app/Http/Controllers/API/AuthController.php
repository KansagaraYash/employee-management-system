<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $user->tokens()->delete();
            $token = $user->createToken('auth_token')->plainTextToken;

            return ok('Login successful',$token);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
