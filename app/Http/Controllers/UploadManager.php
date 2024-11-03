<?php

namespace App\Http\Controllers;

use App\Models\galleries;
use App\Models\gallery;
use Carbon\Carbon;
use Cookie;
use Illuminate\Http\Request;

class UploadManager extends Controller
{
    function index()
    {
        // Kiểm tra xem cookie 'uid' đã tồn tại chưa
        if (!Cookie::has('uid')) {
            // Tạo dãy số ngẫu nhiên
            $uid = bin2hex(random_bytes(16)); // 32 ký tự hex
            // Lưu vào cookie, với thời gian sống là 30 ngày
            Cookie::queue('uid', $uid, 43200); // 30 days in minutes
        }
        return view('homepage');
    }
    function showGallery()
    {
        // Lấy UID từ cookie
        $uid = Cookie::get('uid');

        $files = galleries::where('uid', $uid)->orderBy('id', 'desc')->get();
        return view('download', compact('files'));
    }
    public function store(Request $request)
    {
        // Lấy UID từ cookie
        $uid = Cookie::get('uid');

        $request->validate([
            'files.*' => 'required|file|max:10240', // Giới hạn 10MB
            'expired_date' => 'required|integer|min:1',
        ]);

        $exp = $request->expired_date;
        // $expiredDate = Carbon::now()->addDays((int) $exp);
        $expiredDate = Carbon::now()->addMinutes(2);

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
                $file->uid = $uid;
                $file->expired_date = $expiredDate;
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
