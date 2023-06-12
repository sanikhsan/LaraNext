<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get all course
        $course = Chapter::paginate(9);
        
        $courses_id = $request->input('courses_id');
        if ($courses_id) {
            $course = Chapter::where('courses_id', $courses_id)->get();
        }

        return ResponseFormatter::success(
            $course,
            'Semua data chapter berhasil diambil'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'courses_id' => ['required', 'exists:courses,id']
        ]);

        $data = Chapter::create([
            'name' => $request->name,
            'courses_id' => $request->courses_id
        ]);

        return ResponseFormatter::success(
            $data,
            'Data chapter berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chapter $chapter)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'courses_id' => ['required', 'exists:courses,id']
        ]);

        $chapter->update([
            'name' => $request->name,
            'courses_id' => $request->courses_id
        ]);

        return ResponseFormatter::success(
            $chapter,
            'Data chapter berhasil diperbaharui'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter)
    {
        $chapter->delete();

        return ResponseFormatter::success(
            $chapter,
            'Data chapter berhasil dihapus'
        );
    }
}
