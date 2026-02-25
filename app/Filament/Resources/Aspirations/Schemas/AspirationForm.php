<?php

namespace App\Filament\Resources\Aspirations\Schemas;

use App\Enums\Status;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class AspirationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('sender_id')
                    ->numeric()
                    ->default(fn() => Auth::id())
                    ->hidden()
                    ->dehydrated(fn() => Auth::user()?->hasRole('user')),
                TextInput::make('staff_id')
                    ->numeric()
                    ->default(fn() => Auth::id())
                    ->hidden()
                    ->dehydrated(fn() => Auth::user()?->hasAnyRole(['admin', 'super_admin'])),
                TextInput::make('title')
                    ->required(),
                TextInput::make('location')
                    ->required(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('photo')
                    ->columnSpanFull()
                    ->required(),
                Select::make('status')
                    ->options(Status::class)
                    ->visibleOn('edit')
                    ->visible(
                        fn() =>
                        Auth::user()?->hasAnyRole(['super_admin', 'admin'])
                    )
                    ->required(),
            ]);
    }
}
