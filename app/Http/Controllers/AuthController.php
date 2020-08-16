<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $v1 = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users|string',
            'password' => 'required|min:6'
        ]);
        if ($v1->fails()) {
            return response()->json([
                "status" => "error",
                "errors" => $v1->errors()
            ], 422);
        }
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" =>Hash::make($request->password)
        ]);

        return response()->json([
            "message" => "the user has been registered please login"
        ]);
    }
    public function login(Request $request)
    {

        $v1 = Validator::make($request->all(), [
            'email' => 'required|email|string',
            'password' => 'required|min:6'
        ]);

        if ($v1->fails()) {
            return response()->json([
                "status" => "error",
                "errors" => $v1->errors()
            ], 422);
        }
        $credentials = $request->only("email", "password");
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => Auth::user()->name,
            'id' => Auth::id()
        ]);
    }
}
