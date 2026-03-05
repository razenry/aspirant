<?php

namespace App\Filament\Resources\Users\RelationManagers;

use App\Enums\FileStatus;
use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class UploadFilesRelationManager extends RelationManager
{
    protected static string $relationship = 'uploadFiles';

    protected static ?string $title = 'Berkas Siswa';

    public function table(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('created_at', 'desc')

            ->columns([

                TextColumn::make('jenis_file')
                    ->label('Jenis File')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                TextColumn::make('nama_file')
                    ->label('Nama File')
                    ->searchable()
                    ->limit(30)
                    ->tooltip(fn($record) => $record->nama_file),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn(?FileStatus $state) => $state?->label())
                    ->color(fn(?FileStatus $state) => $state?->color())
                    ->icon(fn(?FileStatus $state) => $state?->icon())
                    ->sortable(),

                IconColumn::make('path_file')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(
                        fn($record) =>
                        asset('storage/' . $record->path_file)
                    )
                    ->openUrlInNewTab(),
            ])

            ->recordActions([

                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->status !== FileStatus::Accepted)
                    ->action(function ($record) {

                        $record->update([
                            'status' => FileStatus::Accepted,
                            'staff_id' => Auth::id(),
                        ]);

                        Notification::make()
                            ->title('Dokumen Disetujui')
                            ->body(
                                "Halo {$record->pengirim->name},\n\n" .
                                    "Dokumen *{$record->jenis_file->label()}* yang kamu upload telah disetujui oleh " .
                                    Auth::user()->name . ".\n\n" .
                                    "Silakan cek dashboard untuk detail lebih lanjut."
                            )
                            ->success()
                            ->sendToDatabase($record->pengirim);
                    }),

                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->status !== FileStatus::Rejected)
                    ->action(function ($record) {

                        $record->update([
                            'status' => FileStatus::Rejected,
                            'staff_id' => Auth::id(),
                        ]);

                        Notification::make()
                            ->title('Dokumen Ditolak')
                            ->body(
                                "Halo {$record->pengirim->name},\n\n" .
                                    "Dokumen *{$record->jenis_file->label()}* yang kamu upload ditolak oleh " .
                                    Auth::user()->name . ".\n\n" .
                                    "Silakan periksa catatan dan upload ulang dokumen yang benar."
                            )
                            ->danger()
                            ->sendToDatabase($record->pengirim);
                    }),

                Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->action(function ($record) {
                        return response()->download(
                            storage_path('app/public/' . $record->path_file),
                            $record->nama_file
                        );
                    }),
            ])

            ->emptyStateHeading('Belum Ada Berkas')
            ->emptyStateDescription('Siswa belum mengupload dokumen.')
            ->emptyStateIcon('heroicon-o-document-text')

            ->recordClasses(
                fn($record) =>
                match ($record->status) {
                    FileStatus::Accepted => 'bg-green-50 dark:bg-green-900/20',
                    FileStatus::Rejected => 'bg-red-50 dark:bg-red-900/20',
                    default => 'bg-yellow-50 dark:bg-yellow-900/20',
                }
            );
    }
}
