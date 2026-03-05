<?php

namespace App\Filament\Resources\UploadFiles\Schemas;

use App\Enums\FileStatus;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class UploadFileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                Section::make('Upload Dokumen')
                    ->description('Silakan unggah dokumen sesuai jenis yang diminta. Pastikan file terlihat jelas dan tidak buram.')
                    ->icon('heroicon-o-cloud-arrow-up')
                    ->schema([

                        Select::make('jenis_file')
                            ->label('Jenis Dokumen')
                            ->options([
                                'halaman_pertama_tabungan' => '📖 Halaman Pertama Tabungan',
                                'mutasi_terakhir_tabungan' => '📊 Mutasi Terakhir Tabungan',
                                'bukti_tarik_atm' => '🏧 Bukti Tarik ATM',
                                'identitas_siswa' => '🪪 Identitas Siswa',
                            ])
                            ->helperText('Pilih jenis dokumen yang ingin kamu upload.')
                            ->required()
                            ->searchable()
                            ->native(false)
                            ->disabled(fn() => Auth::user()?->hasAnyRole(['admin', 'super_admin'])),

                        FileUpload::make('path_file')
                            ->label('File Dokumen')
                            ->disk('public')
                            ->directory('upload-files')
                            ->preserveFilenames()
                            ->acceptedFileTypes([
                                'application/pdf',
                                'image/jpeg',
                                'image/png',
                            ])
                            ->maxSize(5120)
                            ->helperText('Format: PDF, JPG, PNG. Maksimal 5MB.')
                            ->previewable()
                            ->openable()
                            ->downloadable()
                            ->required()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state instanceof TemporaryUploadedFile) {
                                    $set('nama_file', $state->getClientOriginalName());
                                    $set('tipe_mime', $state->getMimeType());
                                    $set('ukuran_file', $state->getSize());
                                }
                            })
                            ->disabled(fn() => Auth::user()?->hasAnyRole(['admin', 'super_admin'])),

                        Hidden::make('nama_file'),
                        Hidden::make('tipe_mime'),
                        Hidden::make('ukuran_file'),

                        Hidden::make('pengirim_id')
                            ->default(fn() => Auth::id()),

                        Hidden::make('status')
                            ->default(FileStatus::Waiting->value),

                    ])
                    ->columns(1)
                    ->collapsible(),

                Section::make('Status Verifikasi')
                    ->description('Bagian ini hanya dapat diakses oleh staff untuk melakukan verifikasi dokumen.')
                    ->icon('heroicon-o-shield-check')
                    ->schema([

                        Select::make('status')
                            ->label('Status Dokumen')
                            ->options([
                                FileStatus::Waiting->value => 'Menunggu',
                                FileStatus::Accepted->value => 'Disetujui',
                                FileStatus::Rejected->value => 'Ditolak',
                            ])
                            ->required()
                            ->native(false)
                            ->live()
                            ->visible(fn() => Auth::user()?->hasAnyRole(['admin', 'super_admin'])),

                        Textarea::make('catatan')
                            ->label('Catatan Penolakan')
                            ->placeholder('Tuliskan alasan penolakan agar siswa dapat memperbaiki dokumen...')
                            ->rows(3)
                            ->required(
                                fn($get) =>
                                $get('status') === FileStatus::Rejected->value
                            )
                            ->visible(
                                fn($get) =>
                                Auth::user()?->hasAnyRole(['admin', 'super_admin'])
                                    && $get('status') === FileStatus::Rejected->value
                            ),

                        Placeholder::make('info_status')
                            ->label('')
                            ->content('Jika dokumen ditolak, wajib mengisi catatan agar siswa mengetahui alasan perbaikan.')
                            ->visible(
                                fn($get) =>
                                Auth::user()?->hasAnyRole(['admin', 'super_admin'])
                                    && $get('status') === FileStatus::Rejected->value
                            ),

                    ])
                    ->columns(1)
                    ->visible(fn() => Auth::user()?->hasAnyRole(['admin', 'super_admin']))
                    ->collapsible(),

            ]);
    }
}
