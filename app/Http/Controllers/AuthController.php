<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

public function register(Request $request)
{
    $fields = $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|unique:users,email',
        'password' => 'required|string|confirmed',
    ]);

    $user = User::create([
        'name' => $fields['name'],
        'email' => $fields['email'],
        'password' => bcrypt($fields['password']),
    ]);

    $token = $user->createToken('apptoken')->plainTextToken;

    return response()->json(['user' => $user, 'token' => $token], 201);
}

public function login(Request $request)
{
    $fields = $request->validate([
        'email' => 'required|string',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $fields['email'])->first();

    if (!$user || !Hash::check($fields['password'], $user->password)) {
        return response(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('apptoken')->plainTextToken;

    return response()->json(['user' => $user, 'token' => $token], 200);
}

}
