<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlantillaResource\Pages;
use App\Filament\Resources\PlantillaResource\RelationManagers;
use App\Models\Plantilla;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Illuminate\Http\Request;
use Filament\Tables\Columns\DownloadLinkColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MultiSelect;
class PlantillaResource extends Resource
{
    // Nueva propiedad para la URL del archivo PDF
    public $url_to_pdf_file;
    protected static ?string $model = Plantilla::class;
     protected static ?string $navigationLabel = 'Plantillas de Certificados';
    protected static ?string $navigationGroup = 'Administrador de Certificados';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('nombre')
                ->required()
                ->maxLength(255)
                ->unique('plantillas'),
                Select::make('nivel')
                    ->options([
                        '1' => 'Nivel 1',
                        '2' => 'Nivel 2',
                        '3' => 'Nivel 3',
                    ])
                ->required(),
                FileUpload::make('plantilla')
                ->acceptedFileTypes(['application/pdf'])
                ->preserveFilenames()
                ->label('plantlla (pdf)')
                ->required(),
                MultiSelect::make('Users')
                ->relationship('users', 'name')
                ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('nivel')->sortable()->searchable(),
                TextColumn::make('plantilla')->label('Descargar'),
                TextColumn::make('created_at')->dateTime('d-M-Y')->searchable(),
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
            ]);
    }
    public function beforeDelete(Plantilla $plantilla)
    {
        if ($plantilla->archivo) {
            Storage::delete($plantilla->archivo);
        }
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
            'index' => Pages\ListPlantillas::route('/'),
        ];
    }

    public function store(Request $request)
    {
        $pdf = $request->file('plantilla');
        $path = $pdf->store('plantillas');

        $model = new Plantilla;
        $model->pdf = $path;
        $model->save();

        // Asignar la URL del archivo PDF a la propiedad correspondiente
        $this->url_to_pdf_file = asset($path);

        return redirect()->back();
    }


  
    
}
