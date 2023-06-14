<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return ResponseFormatter::success(
            Review::where('course_id', $request->course_id)->get(),
            'Data semua Review pada Course ini berhasil diambil'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['exists:users,id', 'numeric'],
            'course_id' => ['required', 'exists:courses,id', 'numeric'],
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'note' => ['string'],
        ]);

        $data = Review::create([
            'user_id' => $request->user()->id,
            'course_id' => $request->course_id,
            'rating' => $request->rating,
            'note' => $request->note
        ]);

        return ResponseFormatter::success(
            $data,
            'Data review berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return ResponseFormatter::success(
            $review->where('user_id', Auth::user()->id)->get(),
            'Data review course berhasil diambil'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'user_id' => ['exists:users,id', 'numeric'],
            'course_id' => ['exists:courses,id', 'numeric', 'unique:courses,id,'.$review->id.',id'],
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'note' => ['string'],
        ]);

        $review->update([
            'rating' => $request->rating,
            'note' => $request->note
        ]);

        return ResponseFormatter::success(
            $review,
            'Data review Course berhasil diperbaharui'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return ResponseFormatter::success(
            $review,
            'Data review course berhasil dihapus'
        );
    }
}
