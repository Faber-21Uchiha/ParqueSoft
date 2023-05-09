<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstudiantesResource\Pages;
use App\Filament\Resources\EstudiantesResource\RelationManagers;
use App\Models\Estudiantes;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\BooleanColumn;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class EstudiantesResource extends Resource
{
    protected static ?string $model = Estudiantes::class;
    protected static ?string $navigationLabel = 'Estudiantes';
    protected static ?string $navigationGroup = 'Informacion de estudiantes';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                TextInput::make('identificacion')
                    ->required()
                    ->maxLength(255),
                TextInput::make('entidad')
                    ->required()
                    ->maxLength(255),
                TextInput::make('cargo')
                    ->required()
                    ->maxLength(255),
                TextInput::make('telefono')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->label('Email address')
                    ->required()
                    // ->unique('Estudiantes')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('nombre')->sortable()->searchable()->toggleable(),
                TextColumn::make('identificacion')->sortable()->searchable()->toggleable(),
                TextColumn::make('entidad')->sortable()->searchable()->toggleable(),
                TextColumn::make('cargo')->sortable()->searchable()->toggleable(),
                TextColumn::make('telefono')->sortable()->searchable()->toggleable(),
                TextColumn::make('email')->sortable()->searchable()->toggleable(),
                TextColumn::make('created_at')->dateTime('d-M-Y')->toggleable()
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until')->default(now()),
                    ])
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEstudiantes::route('/'),
            'create' => Pages\CreateEstudiantes::route('/create'),
            'edit' => Pages\EditEstudiantes::route('/{record}/edit'),
        ];
    }
}
