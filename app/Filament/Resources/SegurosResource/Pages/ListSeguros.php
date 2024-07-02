<?php

namespace App\Filament\Resources\SegurosResource\Pages;

use App\Filament\Resources\SegurosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSeguros extends ListRecords
{
    protected static string $resource = SegurosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
