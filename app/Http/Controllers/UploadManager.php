<?php

namespace App\Http\Controllers;

use App\Models\galleries;
use App\Models\gallery;
use Illuminate\Http\Request;

class UploadManager extends Controller
{
    function index()
    {
        $files = galleries::orderBy('id', 'desc')->get();
        return view('download', compact('files'));
    }
    public function store(Request $request)
    {
        $downloadLinks = [];
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $uploadedFile) {
                $fileName = $uploadedFile->getClientOriginalName();
                $filePath = 'public/uploads/' . $fileName;
                $file = new galleries();
                $file->file_name = $fileName;
                $file->file_path = $filePath;
                $file->file_type = $uploadedFile->getClientMimeType();
                $file->file_size = $uploadedFile->getSize();
                $file->save();
                $uploadedFile->move(public_path('uploads'), $fileName);
                $downloadLinks[] = url('http://127.0.0.1:8000/download/' . $file->id);
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
    public function download($id)
    {
        $file = galleries::find($id);
        if ($file) {
            $path = public_path('uploads/' . $file->file_name);
            return response()->download($path);
        }
        return redirect()->back()->with('error', 'File không tồn tại.');
    }
}
