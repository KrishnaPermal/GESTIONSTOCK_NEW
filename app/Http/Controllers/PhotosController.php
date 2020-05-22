<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class PhotosController extends Controller
{
    public function index($filename)
    {
        function getPhotoContentType($file)
        {
            $mime = exif_imagetype($file);

            if ($mime === IMAGETYPE_JPEG)
                $contentType = 'photo/jpeg';

            elseif ($mime === IMAGETYPE_GIF)
                $contentType = 'photo/gif';

            else if ($mime === IMAGETYPE_PNG)
                $contentType = 'photo/png';

            else
                $contentType = false;

            return $contentType;
        }
        $filePath = storage_path() . '/public/storage/images/' . $filename;
        if (!File::exists($filePath) or (!$mimeType = getPhotoContentType($filePath))) {
            return Response::make("File does not exist.", 404);
        }
        $fileContents = File::get($filePath);

        return Response::make($fileContents, 200, array('Content-Type' => $mimeType));
    }
}
