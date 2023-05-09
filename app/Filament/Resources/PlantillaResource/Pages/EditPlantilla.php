<?php

namespace App\Filament\Resources\PlantillaResource\Pages;

use App\Filament\Resources\PlantillaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlantilla extends EditRecord
{
    protected static string $resource = PlantillaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
