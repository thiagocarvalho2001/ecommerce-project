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

        $image->scale(width: 300);
        $image->scale(height: 300);

        if (!is_dir('images')){
            mkdir('images');
        }

        $originalFile = pathinfo($filename, PATHINFO_FILENAME);
        $resizedFilename = $originalFile . '_resized.jpg';
        $resizedImage = $image->toJpeg()->save('images/' . $resizedFilename );

        return new StreamedResponse(function () use ($resizedImage) {
            echo $resizedImage;
        }, 200, [
            'Content-Type' => 'image/jpeg',
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }
}