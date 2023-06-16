<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('setRole:admin');
        $this->middleware('setRole:student')->only(['index']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get all lessons
        $lesson = Lesson::paginate(9);

        // Filter lesson by chapter
        $chapter_id = $request->input('chapter_id');

        if ($chapter_id) {
            $lesson = Lesson::where('chapter_id', $chapter_id);
        }

        return ResponseFormatter::success(
            $lesson,
            'Data pelajaran berhasil diambil'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'video' => ['required', 'url'],
            'chapter_id' => ['required', 'exists:chapters,id']
        ]);

        $data = Lesson::create([
            'name' => $request->name,
            'video' => $request->video,
            'chapter_id' => $request->chapter_id
        ]);

        return ResponseFormatter::success(
            $data,
            'Data pelajaran berhasil disimpan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'video' => ['required', 'url'],
            'chapter_id' => ['required', 'exists:chapters,id']
        ]);

        $lesson->update([
            'name' => $request->name,
            'video' => $request->video,
            'chapter_id' => $request->chapter_id
        ]);

        return ResponseFormatter::success(
            $lesson,
            'Data pelajaran berhasil diperbaharui'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return ResponseFormatter::success(
            $lesson,
            'Data pelajaran berhasil dihapus'
        );
    }
}
