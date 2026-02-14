<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;
use STS\FilamentImpersonate\Actions\Impersonate;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('grade.name')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('roles')
                    ->label('Role')
                    ->multiple()
                    ->options(
                        Role::query()
                            ->orderBy('name')
                            ->pluck('name', 'name')
                            ->toArray()
                    )
                    ->query(function ($query, array $data) {
                        if (empty($data['value'])) {
                            return;
                        }

                        $query->whereHas('roles', function ($q) use ($data) {
                            $q->whereIn('name', $data['value']);
                        });
                    }),

            ])
            ->recordActions([
                ActionGroup::make([
                    Impersonate::make()->color('info'),
                    Action::make('assignRole')
                        ->label('Assign Role')
                        ->icon('heroicon-o-shield-check')
                        ->color('secondary')
                        ->form([
                            Select::make('roles')
                                ->label('Roles')
                                ->multiple()
                                ->searchable()
                                ->options(Role::pluck('name', 'name'))
                                ->preload()
                                ->required(),
                        ])
                        ->fillForm(function ($record) {
                            return [
                                'roles' => $record->roles->pluck('name')->toArray(),
                            ];
                        })
                        ->action(function ($record, array $data) {
                            $record->syncRoles($data['roles']);
                        })
                        ->successNotificationTitle('Role berhasil di-assign'),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
