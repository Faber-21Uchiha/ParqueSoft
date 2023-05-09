<?php

namespace App\Filament\Resources\EstudiantesResource\Pages;

use App\Filament\Resources\EstudiantesResource;
use Filament\Pages\Actions;
use App\Filament\Resources\UserResource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;

class CreateEstudiantes extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;
    protected static string $resource = EstudiantesResource::class;
    protected function getSteps(): array
    {
        return [
            Step::make('Cuenta')
                ->description('Datos de la Cuenta')
                ->schema([
                    TextInput::make('nombre')
                        ->required(),
                    TextInput::make('email')
                        ->unique('Estudiantes')
                        ->required(),
                    TextInput::make('identificacion')->integer()
                        ->maxLength(255)
                        ->required(),
                ]),
            Step::make('Personal')
                ->description('Información personal del usuario')
                ->schema([
                    TextInput::make('telefono')->maxLength(255)->integer(),
                    TextInput::make('cargo'),
                    TextInput::make('entidad'),
                ]),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
