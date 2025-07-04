<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request) {
        
        $validator = Validator::make($request->only('name', 'password'), [
            'name' => 'required|unique:users,name',
            'password' => 'required|min:7'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        $user = User::create([
            'name' => $data['name'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully.',
            'token' => $token
        ], 201);
    }

    public function login(Request $request) {

        $validator = Validator::make($request->only('name', 'password'), [
            'name' => 'required',
            'password' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        $credentials = $validator->validated();
    
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.'
            ], 401);
        }
    
        $user = Auth::user();

        // Find existing token
        $existingToken = $user->tokens()->where('name', 'auth_token')->first();
    
        $token = null;
    
        if ($existingToken) {
            // Check expiry based on created_at + config minutes
            if ($existingToken->created_at->addMinutes($expiryMinutes)->isPast()) {
                // Expired - delete and regenerate
                $existingToken->delete();
                $token = $user->createToken('auth_token')->plainTextToken;
            } else {
                // Still valid - reuse the existing token value
                // Note: Token string only shown once, so store token on client securely when first generated
                $token = $existingToken['token'];
            }
        } else {
            // No token exists - generate one
            $token = $user->createToken('auth_token')->plainTextToken;
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Logged in successfully.',
            'token' => $token
        ]);
    }
}
