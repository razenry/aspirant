<?php

namespace App\Filament\Resources\Users\RelationManagers;

use App\Filament\Resources\PenerimaPips\PenerimaPipResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class UploadFilesRelationManager extends RelationManager
{
    protected static string $relationship = 'UploadFiles';

    protected static ?string $relatedResource = PenerimaPipResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ])
            ->columns([
                TextColumn::make('jenis_file')->label('Jenis File'),
                TextColumn::make('nama_file')->label('Nama File'),

                SelectColumn::make('status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
                    ])
                    ->afterStateUpdated(function ($record, $state) {
                        $record->update([
                            'staff_id' => Auth::id(),
                        ]);
                    }),
                IconColumn::make('path_file')
                    ->label('File')
                    ->color('info')
                    ->icon('heroicon-o-eye')
                    ->url(fn($record) => asset('storage/' . $record->path_file))
                    ->openUrlInNewTab(),
            ])->recordActions([
                Action::make('download')
                    ->label('Download File')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function ($record) {
                        return response()->download(
                            storage_path('app/public/' . $record->path_file),
                            $record->nama_file
                        );
                    })
            ]);
    }
}
