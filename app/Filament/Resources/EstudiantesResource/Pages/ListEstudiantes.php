<?php

namespace App\Filament\Resources\EstudiantesResource\Pages;

use App\Filament\Resources\EstudiantesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstudiantes extends ListRecords
{
    protected static string $resource = EstudiantesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
