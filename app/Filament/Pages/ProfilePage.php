<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class ProfilePage extends Page
{
    protected static ?string $navigationLabel = 'Certificados';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Administrador de Certificados';
    protected static string $view = 'filament.pages.profile-page';
    public $name;
    public $email;
    public $Plantillas;
    public function mount()
    {
        $user = Auth::user();
        $plantilla_user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->Plantillas = $plantilla_user->Plantillas;
    }
}
