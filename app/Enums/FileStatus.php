<?php

namespace App\Enums;

enum FileStatus: String
{
    case Waiting = 'menunggu';
    case Accepted = 'disetujui';
    case Rejected = 'ditolak';

    public function label(): string
    {
        return match ($this) {
            self::Waiting => 'Menunggu',
            self::Accepted => 'Disetujui',
            self::Rejected => 'Ditolak',
        };
    }
}
