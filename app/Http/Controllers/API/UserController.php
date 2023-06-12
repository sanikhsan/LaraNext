<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ResponseFormatter::success([
            User::paginate(9)
        ],
            'Data semua User berhasil diambil'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return ResponseFormatter::success(
            $user,
            'Data user berhasil diambil'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email,'.$user->id.',id'],
            'profession' => ['string'],
            'avatar' => ['string'],
        ]);

        $user->update($request->all());

        return ResponseFormatter::success(
            $user,
            'Data user berhasil diperbaharui'
        );
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return ResponseFormatter::error(
                null,
                'Password saat ini salah',
                401
            );
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return ResponseFormatter::success(
            $user,
            'Data Password user berhasil diperbaharui'
        );
    }
}
