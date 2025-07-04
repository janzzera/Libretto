<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
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

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully.'
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
    
        if (!Auth::attempt(["name" => $credentials["name"], "password" => $credentials["password"]])) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.'
            ], 401);
        }
    
        $user = Auth::user();
<<<<<<< HEAD:app/Http/Controllers/Api/AuthController.php

        // Find existing token
=======
    
>>>>>>> 3848a16b72f97e39983d7f6965eefe37bce517a8:app/Http/Controllers/Api/UserController.php
        $existingToken = $user->tokens()->where('name', 'auth_token')->first();
    
        $token = null;
    
        if ($existingToken) {
            if ($existingToken->expires_at && now()->greaterThan($existingToken->expires_at)) {
                $existingToken->delete();
                $token = $user->createToken('auth_token', ['*'], now()->addDay())->plainTextToken;
            } else {
<<<<<<< HEAD:app/Http/Controllers/Api/AuthController.php
                // Still valid - reuse the existing token value
                // Note: Token string only shown once, so store token on client securely when first generated
                $token = $existingToken['token'];
=======
                $token = "Token expires at $existingToken->expires_at";
>>>>>>> 3848a16b72f97e39983d7f6965eefe37bce517a8:app/Http/Controllers/Api/UserController.php
            }
        } else {
            $token = $user->createToken('auth_token', ['*'], now()->addDay())->plainTextToken;
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Logged in successfully.',
            'token' => $token
        ]);
    }
}
