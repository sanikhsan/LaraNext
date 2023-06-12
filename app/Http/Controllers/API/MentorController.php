<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Mentor;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ResponseFormatter::success(
            Mentor::paginate(9),
            'Semua data mentor berhasil diambil'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'profile' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:mentors,email'],
            'profession' => ['string']
        ]);

        $data = Mentor::create([
            'name' => $request->name,
            'profile' => $request->profile,
            'email' => $request->email,
            'profession' => $request->profession
        ]);

        return ResponseFormatter::success(
            $data,
            'Data mentor berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Mentor $mentor)
    {
        return ResponseFormatter::success(
            $mentor,
            'Data mentor berhasil diambil'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mentor $mentor)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'profile' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:mentors,email,'.$mentor->id.',id'],
            'profession' => ['string']
        ]);

        $mentor->update([
            'name' => $request->name,
            'profile' => $request->profile,
            'email' => $request->email,
            'profession' => $request->profession
        ]);

        return ResponseFormatter::success(
            $mentor,
            'Data mentor berhasil diperbaharui'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mentor $mentor)
    {
        $mentor->delete();

        return ResponseFormatter::success(
            $mentor,
            'Data mentor berhasil dihapus'
        );
    }
}
