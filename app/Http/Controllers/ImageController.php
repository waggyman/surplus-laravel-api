<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Image::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateImageRequest $request)
    {
        $file = $request->file('image');
        $fileName = time() . '-' . $file->getClientOriginalName();
        $upload = Storage::disk('my_files')->put('images', $file);
        Storage::disk('my_files')->move($upload, 'images/'. $fileName);
        
        $imageDate = [
            'name' => $fileName,
            'file' => '/images/'.$fileName,
            'enable' => true
        ];

        $image = Image::create($imageDate);
        return $image;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Image::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, string $id)
    {
        $currentImage = Image::findOrFail($id);
        
        $file = $request->file('image');
        $fileName = time() . '-' . $file->getClientOriginalName();
        $upload = Storage::disk('my_files')->put('images', $file);
        
        Storage::disk('my_files')->delete($currentImage->file);
        Storage::disk('my_files')->move($upload, 'images/'. $fileName);
        
        Image::where('id', $id)->update([
            'name' => $request->get('name', $currentImage->name),
            'file' => '/images/'.$fileName,
            'enable' => $request->get('enable', $currentImage->enable)
        ]);
        return Image::findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Image::findOrFail($id);
        Image::where('id', $id)->delete();
        return response('', 204);
    }
}
