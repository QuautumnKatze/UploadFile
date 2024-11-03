<?php

use App\Http\Controllers\UploadManager;
use Illuminate\Support\Facades\Route;

Route::get('/', [UploadManager::class, 'index'])->name("homepage");

Route::post('/upload', [UploadManager::class, 'store'])->name('upload');
Route::get('/download', [UploadManager::class, 'showGallery'])->name("showGallery");
Route::get('/download/{id}', [UploadManager::class, 'download'])->name('download.file');
?>