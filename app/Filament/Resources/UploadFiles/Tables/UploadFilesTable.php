<?php

namespace App\Filament\Resources\UploadFiles\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class UploadFilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('pengirim.name')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis_file')
                    ->label('Jenis Dokumen')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'halaman_pertama_tabungan' => 'Halaman Pertama Tabungan',
                        'mutasi_terakhir_tabungan' => 'Mutasi Terakhir Tabungan',
                        'bukti_tarik_atm' => 'Bukti Tarik ATM',
                        'identitas_siswa' => 'Identitas Siswa',
                        default => $state,
                    })
                    ->badge()
                    ->color('info'),

                TextColumn::make('nama_file')
                    ->label('Nama File')
                    ->limit(25)
                    ->tooltip(fn($record) => $record->nama_file),

                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'menunggu',
                        'success' => 'disetujui',
                        'danger' => 'ditolak',
                    ])
                    ->icons([
                        'heroicon-o-clock' => 'menunggu',
                        'heroicon-o-check-circle' => 'disetujui',
                        'heroicon-o-x-circle' => 'ditolak',
                    ]),

                IconColumn::make('path_file')
                    ->label('File')
                    ->color('info')
                    ->icon('heroicon-o-eye')
                    ->url(fn($record) => asset('storage/' . $record->path_file))
                    ->openUrlInNewTab(),

                TextColumn::make('created_at')
                    ->label('Tanggal Upload')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('deleted_at')
                    ->label('Dihapus')
                    ->dateTime('d M Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),

            ])

            ->filters([

                SelectFilter::make('status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
                    ]),

                SelectFilter::make('jenis_file')
                    ->options([
                        'halaman_pertama_tabungan' => 'Halaman Pertama Tabungan',
                        'mutasi_terakhir_tabungan' => 'Mutasi Terakhir Tabungan',
                        'bukti_tarik_atm' => 'Bukti Tarik ATM',
                        'identitas_siswa' => 'Identitas Siswa',
                    ]),

                TrashedFilter::make(), // filter soft delete

            ])

            ->recordActions([
                Action::make('download')
                    ->label('Download File')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function ($record) {
                        return response()->download(
                            storage_path('app/public/' . $record->path_file),
                            $record->nama_file
                        );
                    }),

                ViewAction::make()->color('info'),

                EditAction::make()->color('warning'),

                DeleteAction::make(),

                RestoreAction::make()
                    ->visible(fn($record) => $record->trashed()),

                ForceDeleteAction::make()
                    ->visible(fn($record) => $record->trashed()),

            ])

            ->toolbarActions([

                BulkActionGroup::make([

                    DeleteBulkAction::make(),

                    RestoreBulkAction::make(),

                    ForceDeleteBulkAction::make(),

                ]),

            ]);
    }
}
