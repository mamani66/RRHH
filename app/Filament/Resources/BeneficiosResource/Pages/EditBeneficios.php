<?php

namespace App\Filament\Resources\BeneficiosResource\Pages;

use App\Filament\Resources\BeneficiosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBeneficios extends EditRecord
{
    protected static string $resource = BeneficiosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
