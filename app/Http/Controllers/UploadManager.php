<?php

namespace App\Http\Controllers;

use App\Models\galleries;
use App\Models\gallery;
use Illuminate\Http\Request;

class UploadManager extends Controller
{
    function gallery()
    {

    }
    public function store(Request $request)
    {
        $downloadLinks = [];
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $uploadedFile) {
                $existingFile = galleries::where('file_name', $uploadedFile->getClientOriginalName())->first();

                if (!$existingFile) {
                    $fileName = $uploadedFile->getClientOriginalName();
                    $filePath = 'public/uploads/' . $fileName;
                    $file = new galleries();
                    $file->file_name = $fileName;
                    $file->file_path = $filePath;
                    $file->file_type = $uploadedFile->getClientMimeType();
                    $file->file_size = $uploadedFile->getSize();
                    $file->save();
                    $uploadedFile->move(public_path('uploads'), $fileName);

                } else {
                    continue;
                }
            }
        }

        return response()->json([
            'message' => 'Tải danh sách Files thành công',
            'downloadLinks' => $downloadLinks
        ]);
    }

    function display()
    {
        $galleries = galleries::all();
        return view('gallery', compact('galleries'));
    }


}
