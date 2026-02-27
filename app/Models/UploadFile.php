<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadFile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'pengirim_id',
        'staff_id',
        'jenis_file',
        'nama_file',
        'path_file',
        'tipe_mime',
        'ukuran_file',
        'status',
        'catatan',
    ];

    protected $casts = [
        'jenis_file' => \App\Enums\FileType::class,
        'status' => \App\Enums\FileStatus::class,
    ];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

}
