<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get all lessons
        $lesson = Lesson::paginate(9);

        // Filter lesson by chapter
        $chapters_id = $request->input('chapters_id');

        if ($chapters_id) {
            $lesson = Lesson::where('chapters_id', $chapters_id);
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
            'chapters_id' => ['required', 'exists:chapters,id']
        ]);

        $data = Lesson::create([
            'name' => $request->name,
            'video' => $request->video,
            'chapters_id' => $request->chapters_id
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
            'chapters_id' => ['required', 'exists:chapters,id']
        ]);

        $lesson->update([
            'name' => $request->name,
            'video' => $request->video,
            'chapters_id' => $request->chapters_id
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
