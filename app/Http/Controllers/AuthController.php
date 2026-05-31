<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    public function register(Request $request) {
        try {
            $validated = $request->validate([
                'name'=>'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name'=>$validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'user',
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 400);
        }
    }

    public function login(Request $request) {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $user = User::where('email',$validated['email'])->first();

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid credentials',
                ], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 400);
        }
    }
    public function logout(Request $request) {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Logout successful',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Logout failed',
            ], 500);
        }
    }

    public function profile() {
        $result = User::with('saldo')->findOrFail(auth()->id());
        return response()->json([
            'status'=>'success',
            'message'=>'success retrieved profile',
            'data'=>$result,
        ]);
    }
    public function tambahSaldo(Request $request) {
        $validate = $request->validate([
            'saldo' => 'required|numeric|min:10000',
            'payment_method'=>'required'
        ]);
        DB::transaction(function() use ($validate) {
            $user = User::findOrFail(auth()->id());
            $saldo = Saldo::firstOrCreate(
                [
                    'user_id' => $user->id
                ],
                [
                    'saldo' => 0,
                    'payment_method' => $validate['payment_method']
                ]
            );
            $saldo->increment(
                'saldo',
                $validate['saldo']
            );
        });
        return response()->json([
            'status'=>'success',
            'message'=>'saldo berhasil ditambah',
        ]);
    }
}
