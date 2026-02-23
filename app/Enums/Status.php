<?php

namespace App\Enums;

enum Status: String
{
    case Pending = 'pending';
    case Process = 'process';
    case Done = 'done';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Process => 'In Process',
            self::Done => 'Done',
            self::Rejected => 'Rejected',
        };
    }
}
