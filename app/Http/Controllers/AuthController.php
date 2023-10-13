<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('someProtectedRoute');
    }

    // function register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        //declare uuid
        $uuid = Str::uuid();

        $user = new User([
            'uuid'      => $uuid,
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => Hash::make($request->input('password')),
            'id_role'   => 2, // ID 2 untuk peran "user"
        ]);

        $user->save();

        return response()->json(
            [
                'message' => 'User registered successfully'
            ],
            201
        );
    }

    // function login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            // Create a custom response array without the 'id' field
            $response = [
                'user' => [
                    'uuid' => $user->uuid,
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => $user->email_verified_at,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ],
                'token' => $token,
            ];

            return response()->json($response, 200);
        }

        return response()->json(
            [
                'message' => 'Unauthorized'
            ],
            401
        );
    }

    //function get user login
    public function getLoggedInUser(Request $request)
    {
        $user = $request->user();
        return response()->json($user);
    }

    // function logout
    public function logout(Request $request)
    {
        if (auth()->check()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }
}
