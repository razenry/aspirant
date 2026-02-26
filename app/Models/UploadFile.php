<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
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
        'status' => \App\Enums\Status::class,
    ];

    // Relasi dengan User (pengirim)
    public function sender()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    // Relasi dengan User (staff yang memverifikasi)
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
