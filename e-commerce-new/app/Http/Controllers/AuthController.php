<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        // Attempt to log in the user
        if (Auth::attempt($request->only('email', 'password'))) {
            // If login is successful, generate a token and respond
            $token = Auth::user()->createToken('authToken')->accessToken;
    
            return response()->json([
                'status' => 'success',
                'user' => Auth::user(),
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ],
            ]);
        }
    
        // If login fails, respond with an error
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized',
        ], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'phone_number' => 'required|numeric',
            'email' => 'required|string|email|unique:users',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'user_type_id' => 'required|exists:user_types,id',
        ]);

        $user = User::create([
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'user_type_id' => $request->user_type_id,
        ]);

        $token = Auth::login($user);

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

}
