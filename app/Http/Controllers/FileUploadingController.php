<?php

namespace App\Http\Controllers;

use App\Http\Requests\Upload\TinymceRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileUploadingController extends Controller
{
    /**
     * Method called from TinyMCE plugin for uploading pictures
     *
     * @param  TinymceRequest $request
     * @return JsonResponse
     */
    public function uploadTinyMceImage(TinymceRequest $request): JsonResponse
    {
        if($file = $request->file('file')->store('images/tinymce')) {
            Log::info('Uploaded new file by TinyMCE.', ['file' => $file]);
            return response()->json(['location' => Storage::url($file)]);
        }

        Log::warning('Problems in file uploading by TinyMCE.');
        return response()->json(['status' => false, 'message' => 'Problems in file uploading'], 400);

    }
}
