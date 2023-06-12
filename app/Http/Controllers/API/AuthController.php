<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use PharIo\Manifest\Email;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required','string'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return ResponseFormatter::success(
            $user,
            'User created Successfully'
        );
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return ResponseFormatter::error(
                null,
                'Invalid Credentials',
                401
            );
        }

        $token = $user->createToken('authToken', ['*'], Carbon::now()->addDays(1))->plainTextToken;

        return ResponseFormatter::success([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $user
        ], 'Authenticated');
    }

    public function logout(Request $request)
    {
        if (!$request->user()) {
            return ResponseFormatter::error(
                null,
                'Invalid Session',
                401
            );
        }

        // Revoked all tokens
        // $request->user()->tokens()->delete();

        // Revoke the token that was used to authenticate the current request...
        $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success(
            null,
            'Token Revoked'
        );
    }
}
