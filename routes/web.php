<?php

use App\Models\UploadFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/download/{uploadFile}', function (UploadFile $uploadFile) {

    if (!Auth::user()->hasAnyRole(['admin','super_admin']) &&
        $uploadFile->pengirim_id !== Auth::id()) {
        abort(403);
    }

    return response()->download(
        storage_path('app/public/' . $uploadFile->path_file),
        $uploadFile->nama_file
    );

})->name('download.file');
