<?php

namespace App\Filament\Resources\ReclutamientosResource\Pages;

use App\Filament\Resources\ReclutamientosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReclutamientos extends ListRecords
{
    protected static string $resource = ReclutamientosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
