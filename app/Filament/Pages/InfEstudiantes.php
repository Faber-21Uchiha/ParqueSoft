<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Estudiantes;
use Illuminate\Support\Facades\Auth;


class InfEstudiantes extends Page
{
    protected static ?string $navigationLabel = 'Informacion';
    protected static ?string $navigationGroup = 'Informacion de estudiantes';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static string $view = 'filament.pages.inf-estudiantes';
    public $emailAuth;
    public $estudiante;
    public function mount()
    {
        $user = Auth::user();
        $this->emailAuth = $user->email;
        $this->estudiante = Estudiantes::where('email', $this->emailAuth)->first();
    }
}
