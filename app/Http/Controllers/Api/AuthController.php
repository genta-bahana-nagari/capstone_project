<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function registration(Request $request) {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => 'required|string|min:8',
        ]);

        // 
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create the user
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);

        $user->assignRole('user'); 

        if($user) {
            $token = JWTAuth::fromUser($user);
            return response()->json([
                'success' => true,
                'user'    => $user,  
                'role'    => $user->getRoleNames(),
                'token'   => $token
            ], 200);
        }

        return response()->json([
            'success' => false
        ], 409);
    }

    public function login(Request $request) {
        $validatior = Validator::make($request->all(), [
            'email' => 'required|string|lowercase|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validatior->fails()) {
            return response()->json($validatior->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password'
            ], 401);            
        }

        return response()->json([
            'success' => true,
            'user'    => auth()->user(),
            'role'    => auth()->user()->getRoleNames(),
            'token'   => $token
        ], 200);
    }

    public function logout(Request $request) {
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        if ($removeToken) {
            return response()->json([
                'success' => true,
                'message' => 'You have been successfully logged out'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Something went wrong'
        ], 500);
    }
}
