<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('upload_files', function (Blueprint $table) {
            $table->id();

            // Relasi pengirim (siswa) dan staff
            $table->foreignId('pengirim_id')
                ->nullable()
                ->constrained('users', 'id')
                ->nullOnDelete();

            $table->foreignId('staff_id')
                ->nullable()
                ->constrained('users', 'id')
                ->nullOnDelete();

            // Jenis file yang diunggah
            $table->enum('jenis_file', [
                'halaman_pertama_tabungan',
                'mutasi_terakhir_tabungan',
                'bukti_tarik_atm',
                'identitas_siswa'
            ]);

            $table->string('nama_file');        // Nama file asli
            $table->string('path_file');        // Lokasi penyimpanan file
            $table->string('tipe_mime')->nullable();
            $table->unsignedBigInteger('ukuran_file')->nullable(); // dalam byte

            // Status verifikasi file
            $table->enum('status', [
                'menunggu',
                'disetujui',
                'ditolak'
            ])->default('menunggu');

            $table->text('catatan')->nullable(); // Alasan jika ditolak
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_files');
    }
};
