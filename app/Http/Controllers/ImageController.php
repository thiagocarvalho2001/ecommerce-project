<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImageController extends Controller
{
    public function show($filename)
    {
        $path = 'products/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        $file = Storage::disk('public')->get($path);

        $manager = new ImageManager(Driver::class);

        $image = $manager->read($file);

        $image->resize(150, 150);

        if (!is_dir('images')) {
            mkdir('images');
        }

        $originalFile = pathinfo($filename, PATHINFO_FILENAME);
        $originalExt = pathinfo($filename, PATHINFO_EXTENSION);
        $resizedFilename = $originalFile . '_resized.' . $originalExt;

        $image->save('images/' . $resizedFilename);

        return new StreamedResponse(function () use ($image) {
            echo $image->encode();
        }, 200, [
            'Content-Type' => 'image',
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }
}