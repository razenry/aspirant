<?php

namespace App\Filament\Resources\PenerimaPips\Pages;

use App\Filament\Resources\PenerimaPips\PenerimaPipResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPenerimaPips extends ListRecords
{
    protected static string $resource = PenerimaPipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
