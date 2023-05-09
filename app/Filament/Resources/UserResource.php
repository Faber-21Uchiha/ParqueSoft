<?php

namespace App\Filament\Resources;
use App\Filament\Resources\UserResource\Widgets\UserStatsOverview;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Plantilla;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MultiSelect;
use Spatie\Permission\Models\Role;
class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationLabel = 'Usuarios';
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Administración de Usuarios';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('name')
                ->required() // Campo requerido
                ->maxLength(255), // Longitud máxima de 255 caracteres

            TextInput::make('email')
                ->label('Email address') // Etiqueta personalizada
                ->required() // Campo requerido
                ->unique('users'), // Verifica que el valor sea único en la tabla 'users'

            TextInput::make('password')
                ->password() // Campo de contraseña enmascarado
                ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord) // Campo requerido solo al crear un registro
                ->minLength(8) // Longitud mínima de 8 caracteres
                ->same('passwordConfirmation') // Verifica que coincida con el campo 'passwordConfirmation'
                ->dehydrated(fn ($state) => filled($state)) // Almacena el estado de manera encriptada
                ->dehydrateStateUsing(fn ($state) => Hash::make($state)), // Encripta el estado de la contraseña

            TextInput::make('passwordConfirmation')
                ->password() // Campo de contraseña enmascarado
                ->label('Password confirmation') // Etiqueta personalizada
                ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord) // Campo requerido solo al crear un registro
                ->minLength(8) // Longitud mínima de 8 caracteres
                ->dehydrated(false), // No almacena el estado de la confirmación de contraseña

            MultiSelect::make('Roles')
                ->relationship('roles', 'name') // Establece una relación con el modelo 'roles' utilizando la columna 'name'
                ->options(function () {
                    return Role::all()->pluck('name', 'id'); // Obtiene las opciones de la tabla 'roles'
                })
                ->default('Estudiantes'), // Valor predeterminado seleccionado

            Select::make('permissions')
                ->multiple() // Permite seleccionar múltiples opciones
                ->relationship('permissions', 'name') // Establece una relación con el modelo 'permissions' utilizando la columna 'name'
                ->preload(), // Precarga los datos de la relación

            MultiSelect::make('Plantilla')
                ->relationship('plantillas', 'plantilla') // Establece una relación con el modelo 'plantillas' utilizando la columna 'plantilla'
                ->preload(), // Precarga los datos de la relación
        ]);
}
// 

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime('d-M-Y')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make(),
            ]);
    }
    public static function  getWidgets(): array
    {
        return[
            UserStatsOverview::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }  
    public function edit(User $user)
    {
        $plantillas = Plantilla::all();
        return view('edit', compact('user', 'plantillas'));
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('name', '!=', 'Admin');
    }  
}
