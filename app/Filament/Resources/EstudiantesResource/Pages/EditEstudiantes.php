<?php

namespace App\Filament\Resources\EstudiantesResource\Pages;

use App\Filament\Resources\EstudiantesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstudiantes extends EditRecord
{
    protected static string $resource = EstudiantesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
