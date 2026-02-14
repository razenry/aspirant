<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),

                TextInput::make('password')
                    ->password()
                    ->label('Password')
                    ->nullable() // ⬅ nullable saat update
                    ->dehydrateStateUsing(
                        fn($state) =>
                        filled($state) ? Hash::make($state) : null
                    )
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $operation) => $operation === 'create') // wajib hanya saat create
                    ->suffixAction(
                        Action::make('resetPassword')
                            ->label('Set Default')
                            ->icon('heroicon-o-key')
                            ->action(function ($set) {
                                $defaultPassword = 'password'; // ganti sesuai kebutuhan
                                $set('password', $defaultPassword);
                            })
                    ),

                Select::make('grade_id')
                    ->label('Grade')
                    ->relationship('grade', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
            ]);
    }
}
