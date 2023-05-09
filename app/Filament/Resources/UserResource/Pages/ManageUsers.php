<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\Widgets\UserStatsOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Notifications\Notification;
class ManageUsers extends ManageRecords
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return[
            UserStatsOverview::class,
        ];
    }
}
