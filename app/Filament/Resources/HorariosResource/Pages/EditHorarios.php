<?php

namespace App\Filament\Resources\HorariosResource\Pages;

use App\Filament\Resources\HorariosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHorarios extends EditRecord
{
    protected static string $resource = HorariosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
