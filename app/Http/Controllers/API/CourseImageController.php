<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\CourseImage;
use Illuminate\Http\Request;

class CourseImageController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * public function index()
     * {
     *   return ResponseFormatter::success(
     *       CourseImage::paginate(9),
     *       'Semua data Course Image berhasil diambil'
     *   );
     * }
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'url'],
            'courses_id' => ['required', 'exists:courses,id']
        ]);

        $data = CourseImage::create([
            'image' => $request->image,
            'courses_id' => $request->courses_id
        ]);
        
        return ResponseFormatter::success(
            $data,
            'Data Course Image berhasil ditambahkan'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseImage $courseImage)
    {
        $courseImage->delete();

        return ResponseFormatter::success(
            $courseImage,
            'Data Course Image berhasil dihapus'
        );
    }
}
