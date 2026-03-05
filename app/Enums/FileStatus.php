<?php

namespace App\Enums;

enum FileStatus: string
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

    public function color(): string
    {
        return match ($this) {
            self::Waiting => 'warning',
            self::Accepted => 'success',
            self::Rejected => 'danger',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Waiting => 'heroicon-o-clock',
            self::Accepted => 'heroicon-o-check-circle',
            self::Rejected => 'heroicon-o-x-circle',
        };
    }
}
