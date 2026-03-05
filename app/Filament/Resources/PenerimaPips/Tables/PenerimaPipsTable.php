<?php

namespace App\Filament\Resources\PenerimaPips\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PenerimaPipsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->modifyQueryUsing(
                fn($query) =>
                $query->withCount('uploadFiles')
            )

            ->defaultSort('upload_files_count', 'asc')

            ->columns([

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-o-envelope')
                    ->color('gray')
                    ->toggleable(),

                TextColumn::make('upload_files_count')
                    ->label('Jumlah File')
                    ->badge()
                    ->sortable()
                    ->formatStateUsing(
                        fn($state) =>
                        match (true) {
                            $state == 4 => 'Lengkap',
                            $state == 0 => 'Belum Upload',
                            default => $state . ' / 4 Berkas',
                        }
                    )
                    ->color(
                        fn($state) =>
                        match (true) {
                            $state == 4 => 'success',
                            $state >= 2 => 'warning',
                            default => 'danger',
                        }
                    )
                    ->icon(
                        fn($state) =>
                        match (true) {
                            $state == 4 => 'heroicon-o-check-circle',
                            $state >= 2 => 'heroicon-o-clock',
                            default => 'heroicon-o-x-circle',
                        }
                    ),
            ])

            ->recordActions([
                EditAction::make()->label('Lihat Detail')->icon('heroicon-o-eye'),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
