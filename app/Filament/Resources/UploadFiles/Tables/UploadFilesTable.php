<?php

namespace App\Filament\Resources\UploadFiles\Tables;

use App\Enums\FileStatus;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
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

            ->striped()
            ->defaultSort('created_at', 'desc')

            ->columns([

                TextColumn::make('pengirim.name')
                    ->label('Siswa')
                    ->icon('heroicon-o-user')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                TextColumn::make('jenis_file')
                    ->label('Jenis Dokumen')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'halaman_pertama_tabungan' => 'Halaman Pertama Tabungan',
                        'mutasi_terakhir_tabungan' => 'Mutasi Terakhir Tabungan',
                        'bukti_tarik_atm' => 'Bukti Tarik ATM',
                        'identitas_siswa' => 'Identitas Siswa',
                        default => $state,
                    }),

                TextColumn::make('nama_file')
                    ->label('Nama File')
                    ->limit(30)
                    ->tooltip(fn($record) => $record->nama_file)
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable()
                    ->formatStateUsing(fn(?FileStatus $state) => $state?->label())
                    ->color(fn(?FileStatus $state) => $state?->color())
                    ->icon(fn(?FileStatus $state) => $state?->icon()),

                IconColumn::make('path_file')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn($record) => asset('storage/' . $record->path_file))
                    ->openUrlInNewTab(),

                TextColumn::make('created_at')
                    ->label('Tanggal Upload')
                    ->icon('heroicon-o-calendar-days')
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
                        FileStatus::Waiting->value => 'Menunggu',
                        FileStatus::Accepted->value => 'Disetujui',
                        FileStatus::Rejected->value => 'Ditolak',
                    ]),

                SelectFilter::make('jenis_file')
                    ->options([
                        'halaman_pertama_tabungan' => 'Halaman Pertama Tabungan',
                        'mutasi_terakhir_tabungan' => 'Mutasi Terakhir Tabungan',
                        'bukti_tarik_atm' => 'Bukti Tarik ATM',
                        'identitas_siswa' => 'Identitas Siswa',
                    ]),

                TrashedFilter::make(),
            ])

            ->recordActions([
                ActionGroup::make([

                    Action::make('download')
                        ->label('Download')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->action(
                            fn($record) =>
                            response()->download(
                                storage_path('app/public/' . $record->path_file),
                                $record->nama_file
                            )
                        ),

                    ViewAction::make()->color('info'),

                    EditAction::make()->color('warning'),

                    DeleteAction::make(),

                    RestoreAction::make()
                        ->visible(fn($record) => $record->trashed()),

                    ForceDeleteAction::make()
                        ->visible(fn($record) => $record->trashed()),
                ]),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ])

            ->recordClasses(
                fn($record) =>
                match ($record->status) {
                    FileStatus::Accepted => 'bg-green-50 dark:bg-green-900/20',
                    FileStatus::Rejected => 'bg-red-50 dark:bg-red-900/20',
                    default => 'bg-yellow-50 dark:bg-yellow-900/20',
                }
            )

            ->emptyStateHeading('Belum Ada Upload File')
            ->emptyStateDescription('Data upload siswa akan muncul di sini.')
            ->emptyStateIcon('heroicon-o-document-text');
    }
}
