<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Media;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ResponseFormatter::success(
            Media::paginate(9),
            'Data semua media berhasil diambil'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'base64image'
        ]);

        $getExtension = explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        $getImage = explode(";base64,", $request->image);
        $imageName = "Image-".Str::random(7)."-".Carbon::today()->toDateString().'.'.$getExtension;
        $base64image = base64_decode($getImage[1]);
        Storage::put("/public/images/".$imageName, $base64image);

        $data = Media::create([
            'image' => env("APP_URL")."/storage/images/".$imageName
        ]);

        return ResponseFormatter::success(
            $data,
            'Data berhasil disimpan'
        );
    }

    public function show(Media $medium)
    {
        return ResponseFormatter::success(
            $medium,
            'Data media berhasil diambil'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $medium)
    {
        $url = str_replace("https://laranext.dev/storage/", "/public/", $medium->image);
        Storage::delete($url);

        $medium->delete();

        return ResponseFormatter::success(
            $medium,
            'Data media berhasil dihapus'
        );
    }
}
