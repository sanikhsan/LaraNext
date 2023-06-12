<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\MyCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return ResponseFormatter::success(
            MyCourse::where('users_id', $request->user()->id)->get(),
            'Data Course berhasil diambil'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'users_id' => ['exists:users,id'],
            'courses_id' => ['required', 'exists:courses,id', 'unique:courses,id']
        ]);

        $data = MyCourse::create([
            'users_id' => $request->user()->id,
            'courses_id' => $request->courses_id
        ]);

        return ResponseFormatter::success(
            $data,
            'Data Course berhasil ditambahkan ke akun saya'
        );
    }
}
