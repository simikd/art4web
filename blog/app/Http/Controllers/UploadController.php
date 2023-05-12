<?php

namespace App\Http\Controllers;

use App\Models\File;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class UploadController extends Controller
{

    public const STORAGE_BASE_DIR = '/storage/';

    /**
     * Store and save uploaded files to db.
     *
     * @throws Exception
     */
    public function upload(Request $request): JsonResponse
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            if (!$file->isValid()) {
                throw new RuntimeException('Invalid file upload');
            }

            $fileRecord = new File();
            $fileRecord->path = self::STORAGE_BASE_DIR . $file->store('uploads', 'public');
            $fileRecord->type = $file->extension();
            $fileRecord->name = $file->getClientOriginalName();
            $fileRecord->save();

            return response()->json(['location' => $fileRecord->path]);
        }

        throw new RuntimeException('Invalid file upload');
    }

}
