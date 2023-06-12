<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ResponseFormatter::success(
            Course::paginate(9),
            'Semua data kursus berhasil diambil'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'certificate' => ['required', 'boolean'],
            'thumbnail' => ['string', 'url'],
            'type' => ['required', 'in:FREE, PREMIUM'],
            'status' => ['required', 'in:Draft, Published'],
            'price' => ['required', 'integer'],
            'level' => ['required', 'in:All-Level, Beginner, Intermediate, Advance'],
            'description' => ['string'],
            'mentor_id' => ['required', 'exist:mentors,id']
        ]);

        $data = Course::create($request->all());

        return ResponseFormatter::success(
            $data,
            'Data kursus berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return ResponseFormatter::success(
            $course,
            'Data kursus berhasil diambil'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'certificate' => ['required', 'boolean'],
            'thumbnail' => ['string', 'url'],
            'type' => ['required', 'in:FREE, PREMIUM'],
            'status' => ['required', 'in:Draft, Published'],
            'price' => ['required', 'integer'],
            'level' => ['required', 'in:All-Level, Beginner, Intermediate, Advance'],
            'description' => ['string'],
            'mentor_id' => ['required', 'exist:mentors,id']
        ]);

        $course->update($request->all());

        return ResponseFormatter::success(
            $course,
            'Data kursus berhasil diperbaharui'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return ResponseFormatter::success(
            $course,
            'Data kursus berhasil dihapus'
        );
    }
}