<?php

namespace App\Filament\Resources\Grades\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class GradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('level')
                    ->options([
                        '10' => 10,
                        '11' => 11,
                        '12' => 12,
                    ]),
                TextInput::make('academic_year')
                    ->required(),
            ]);
    }
}
