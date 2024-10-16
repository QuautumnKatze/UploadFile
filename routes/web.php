<?php

use App\Http\Controllers\UploadManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::post('/upload', [UploadManager::class, 'store'])->name('upload');
Route::get('/download', [UploadManager::class, 'index'])->name("download");
Route::get('/download/{id}', [UploadManager::class, 'download'])->name('download.file');
?>