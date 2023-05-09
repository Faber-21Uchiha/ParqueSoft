<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
class Plantilla extends Model
{
    use HasFactory;

    protected $fillable =['name','nivel','plantilla'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

//     public function eliminar(Request $request, $id)
//     {
//         $plantilla = Plantilla::findOrFail($id);
//         $archivo = $plantilla->archivo;
    
//         if ($archivo) {
//             Storage::delete($archivo);
//         }
    
//         $plantilla->delete();
    
//         // Redireccionar a la página de index del recurso
//         return redirect()->route('filament.resources.plantilla-resource.index');
//     }
    
// /*public function fields()
// {
//     return [
//         TextInput::make('title')->required(),
//         FileUpload::make('pdf_file')->acceptedFileTypes(['.pdf'])->maxFileSizeInBytes(5242880)->required(),
//     ];
// }*/
}
