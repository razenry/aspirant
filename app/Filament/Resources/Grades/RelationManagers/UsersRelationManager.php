<?php

namespace App\Filament\Resources\Grades\RelationManagers;

use App\Filament\Resources\Users\UserResource;
use App\Models\Grade;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'students';

    protected static ?string $relatedResource = UserResource::class;

    protected static ?string $title = 'Students';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Full Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email Address')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Registered At')
                    ->dateTime()
                    ->sortable(),
            ])

            ->headerActions([
                Action::make('assignStudents')
                    ->label('Add Students')
                    ->icon('heroicon-o-user-plus')
                    ->color('primary')
                    ->modalWidth('lg')
                    ->form([

                        Select::make('source_grade_id')
                            ->label('Transfer All Students From Class')
                            ->options(
                                Grade::query()
                                    ->where('id', '!=', $this->getOwnerRecord()->id)
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->placeholder('Select a class to transfer all students (optional)')
                            ->helperText('If selected, all students from that class will be moved.')
                            ->reactive(),

                        Select::make('students')
                            ->label('Or Select Individual Students')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->placeholder('Select specific students')
                            ->options(function () {
                                return User::whereNull('grade_id')
                                    ->orderBy('name')
                                    ->pluck('name', 'id');
                            })
                            ->visible(fn(Get $get) => !$get('source_grade_id')),
                    ])
                    ->action(function (array $data, $livewire) {

                        $currentGradeId = $livewire->getOwnerRecord()->id;

                        if (!empty($data['source_grade_id'])) {

                            User::where('grade_id', $data['source_grade_id'])
                                ->update([
                                    'grade_id' => $currentGradeId,
                                ]);

                            return;
                        }

                        if (!empty($data['students'])) {

                            User::whereIn('id', $data['students'])
                                ->update([
                                    'grade_id' => $currentGradeId,
                                ]);
                        }
                    })
                    ->successNotificationTitle('Students successfully assigned')
            ])

            ->recordActions([
                Action::make('removeStudent')
                    ->label('Remove')
                    ->icon('heroicon-o-user-minus')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Remove Student from Class')
                    ->modalDescription('This will remove the student from this class but keep the account.')
                    ->action(function (User $record) {
                        $record->update([
                            'grade_id' => null,
                        ]);
                    })
                    ->successNotificationTitle('Student removed from class'),
            ])

            ->bulkActions([
                BulkAction::make('removeSelected')
                    ->label('Remove Selected')
                    ->icon('heroicon-o-user-minus')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Remove Selected Students')
                    ->modalDescription('Selected students will be removed from this class.')
                    ->action(function ($records) {

                        User::whereIn('id', $records->pluck('id'))
                            ->update([
                                'grade_id' => null,
                            ]);
                    })
                    ->successNotificationTitle('Selected students removed successfully'),
            ]);
    }
}
