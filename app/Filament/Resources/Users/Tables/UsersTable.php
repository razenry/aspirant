<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Exports\UserExporter;
use App\Filament\Imports\UserImporter;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\ImportAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use STS\FilamentImpersonate\Actions\Impersonate;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Collection;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->headerActions([
                ImportAction::make()
                    ->color(Color::Green)
                    ->importer(UserImporter::class)
                    ->after(function (Collection $records) {

                        $importedNames = $records
                            ->pluck('name')
                            ->values()
                            ->map(fn($name, $index) => ($index + 1) . '. ' . $name)
                            ->implode("\n");

                        $admins = User::role(['admin', 'super_admin'])->get();

                        Notification::make()
                            ->title('Users Imported Successfully')
                            ->body(
                                "The following users have been imported by " . Auth::user()->name . ":\n\n" . $importedNames
                            )
                            ->success()
                            ->sendToDatabase($admins);
                    }),
                ExportAction::make()
                    ->color(Color::Gray)
                    ->exporter(UserExporter::class)
                    ->after(function (Collection $records) {

                        $exportedNames = $records
                            ->pluck('name')
                            ->values()
                            ->map(fn($name, $index) => ($index + 1) . '. ' . $name)
                            ->implode("\n");

                        $admins = User::role(['admin', 'super_admin'])->get();

                        Notification::make()
                            ->title('Users Exported Successfully')
                            ->body(
                                "The following users have been exported by " . Auth::user()->name . ":\n\n" . $exportedNames
                            )
                            ->success()
                            ->sendToDatabase($admins);
                    }), 
            ])
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
                        ->successNotificationTitle('Role assigned successfully'),
                    EditAction::make(),
                    ForceDeleteAction::make()->after(function ($record) {

                        $deletedName = $record->name;

                        $admins = User::role(['admin', 'super_admin'])->get();

                        Notification::make()
                            ->title('User Permanently Deleted')
                            ->body('The user "' . $deletedName . '" has been permanently deleted by ' . Auth::user()->name . '.')
                            ->danger()
                            ->sendToDatabase($admins);
                    }),
                    RestoreAction::make()
                        ->color('success')
                        ->after(function ($record) {

                            $restoredName = $record->name;

                            $admins = User::role(['admin', 'super_admin'])->get();

                            Notification::make()
                                ->title('User Restored Successfully')
                                ->body('The user "' . $restoredName . '" has been restored by ' . Auth::user()->name . '.')
                                ->success()
                                ->sendToDatabase($admins);
                        }),
                    DeleteAction::make()
                        ->after(function ($record) {

                            $deletedName = $record->name;

                            $admins = User::role(['admin', 'super_admin'])->get();

                            Notification::make()
                                ->title('User Deleted Successfully')
                                ->body('The user "' . $deletedName . '" has been deleted by ' . Auth::user()->name . '.')
                                ->danger()
                                ->sendToDatabase($admins);
                        }),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->after(function (Collection $records) {

                            $deletedNames = $records
                                ->pluck('name')
                                ->values()
                                ->map(fn($name, $index) => ($index + 1) . '. ' . $name)
                                ->implode("\n");

                            $admins = User::role(['admin', 'super_admin'])->get();

                            Notification::make()
                                ->title('Users Deleted Successfully')
                                ->body(
                                    "The following users have been deleted by " . Auth::user()->name . ":\n\n" . $deletedNames
                                )
                                ->danger()
                                ->sendToDatabase($admins);
                        }),
                    ForceDeleteBulkAction::make()
                        ->after(function (Collection $records) {

                            $deletedNames = $records
                                ->pluck('name')
                                ->values()
                                ->map(fn($name, $index) => ($index + 1) . '. ' . $name)
                                ->implode("\n");

                            $admins = User::role(['admin', 'super_admin'])->get();

                            Notification::make()
                                ->title('Users Permanently Deleted')
                                ->body(
                                    "The following users have been permanently deleted by " . Auth::user()->name . ":\n\n" . $deletedNames
                                )
                                ->danger()
                                ->sendToDatabase($admins);
                        }),

                    RestoreBulkAction::make()
                        ->color('success')
                        ->after(function (Collection $records) {

                            $restoredNames = $records
                                ->pluck('name')
                                ->values()
                                ->map(fn($name, $index) => ($index + 1) . '. ' . $name)
                                ->implode("\n");

                            $admins = User::role(['admin', 'super_admin'])->get();

                            Notification::make()
                                ->title('Users Restored Successfully')
                                ->body(
                                    "The following users have been restored by " . Auth::user()->name . ":\n\n" . $restoredNames
                                )
                                ->success()
                                ->sendToDatabase($admins);
                        }),
                ]),
            ]);
    }
}
