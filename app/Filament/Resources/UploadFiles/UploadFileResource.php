<?php

namespace App\Filament\Resources\UploadFiles;

use App\Filament\Resources\UploadFiles\Pages\CreateUploadFile;
use App\Filament\Resources\UploadFiles\Pages\EditUploadFile;
use App\Filament\Resources\UploadFiles\Pages\ListUploadFiles;
use App\Filament\Resources\UploadFiles\Schemas\UploadFileForm;
use App\Filament\Resources\UploadFiles\Tables\UploadFilesTable;
use App\Models\UploadFile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class UploadFileResource extends Resource
{
    protected static ?string $model = UploadFile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocument;

    protected static ?string $recordTitleAttribute = 'Upload File';

    protected static string | UnitEnum | null $navigationGroup = 'PIP';

    public static function form(Schema $schema): Schema
    {
        return UploadFileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UploadFilesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUploadFiles::route('/'),
            'create' => CreateUploadFile::route('/create'),
            'edit' => EditUploadFile::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        if (!Auth::user()?->hasAnyRole(['admin', 'super_admin'])) {
            $query->where('pengirim_id', Auth::id());
        }

        return $query;
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        $query = parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        if (!Auth::user()?->hasAnyRole(['admin', 'super_admin'])) {
            $query->where('pengirim_id', Auth::id());
        }

        return $query;
    }
}
