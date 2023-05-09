<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Notification::make()
            ->success()
            ->title('Rol Eliminado')
            ->body('El Rol ha sido Eliminado exitosamente!!')
        ];
    }
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Rol Editado')
            ->body('El Rol ha sido Editado exitosamente!!');
    }
}
