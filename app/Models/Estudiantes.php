<?php

namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use JeffGreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Model;

class Estudiantes extends Model
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles, TwoFactorAuthenticatable;
    protected $fillable = [
        'nombre',
        'identificacion',
        'entidad',
        'cargo',
        'telefono',
        'email',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
