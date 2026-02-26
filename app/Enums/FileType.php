<?php

namespace App\Enums;

enum FileType: String
{
    case HPT = 'halaman_pertama_tabungan';
    case MTB = 'mutasi_terakhir_tabungan';
    case BTA = 'bukti_tarik_atm';
    case IS = 'identitas_siswa';

    public function label(): string
    {
        return match ($this) {
            self::HPT => 'Halaman Pertama Tabungan',
            self::MTB => 'Mutasi Terakhir Tabungan',
            self::BTA => 'Bukti Tarik ATM',
            self::IS => 'Identitas Siswa',
        };
    }
}
