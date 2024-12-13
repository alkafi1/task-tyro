<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // login function
    public function login(LoginRequest $request)
    {
        // Attempt to authenticate the user
        if (!Auth::attempt($request->only('email', 'password'))) {
            Helper::sendErr('Email or Passowrd Not match');
        }
        // send response 
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => new UserResource(auth()->user()),
        ], 200);
    }
    // register function
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Register successful',
            'data' => new UserResource($user),
        ], 200);
    }
    // profile detiails function
    public function profile(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'message' => 'User profile retrieved successfully',
            'data' => new UserResource($user),
        ], 200);
    }
    // logout function
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully',
        ], 200);
    }
    
}
