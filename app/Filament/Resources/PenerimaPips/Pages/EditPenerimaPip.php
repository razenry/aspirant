<?php

namespace App\Filament\Resources\PenerimaPips\Pages;

use App\Filament\Resources\PenerimaPips\PenerimaPipResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPenerimaPip extends EditRecord
{
    protected static string $resource = PenerimaPipResource::class;


    public function getTitle(): string
    {
        return 'Detail File: ' . $this->record->name;
    }

    public function getBreadcrumb(): string
    {
        return 'Detail';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
