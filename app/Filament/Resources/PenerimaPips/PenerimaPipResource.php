<?php

namespace App\Filament\Resources\PenerimaPips;

use App\Filament\Resources\PenerimaPips\Pages\CreatePenerimaPip;
use App\Filament\Resources\PenerimaPips\Pages\EditPenerimaPip;
use App\Filament\Resources\PenerimaPips\Pages\ListPenerimaPips;
use App\Filament\Resources\PenerimaPips\Schemas\PenerimaPipForm;
use App\Filament\Resources\PenerimaPips\Tables\PenerimaPipsTable;
use App\Filament\Resources\Users\RelationManagers\UploadFilesRelationManager;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class PenerimaPipResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $pluralModelLabel = 'Penerima PIP';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $navigationLabel = 'Penerima PIP';

    protected static string | UnitEnum | null $navigationGroup = 'PIP';

    public static function getBreadcrumb(): string
    {
        return 'PIP';
    }

    public static function canViewAny(): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'super_admin']);
    }

    public static function form(Schema $schema): Schema
    {
        return PenerimaPipForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenerimaPipsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            UploadFilesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPenerimaPips::route('/'),
            'create' => CreatePenerimaPip::route('/create'),
            'edit' => EditPenerimaPip::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->role('penerima_pip');
    }
}
