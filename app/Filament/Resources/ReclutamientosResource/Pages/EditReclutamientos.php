<?php

namespace App\Filament\Resources\ReclutamientosResource\Pages;

use App\Filament\Resources\ReclutamientosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReclutamientos extends EditRecord
{
    protected static string $resource = ReclutamientosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
