<?php

namespace App\Http\Controllers;

use App\Models\Plantilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function generarPDF(Request $request)
    {
        // Obtener la plantilla seleccionada
        $plantilla = Plantilla::find($request->plantilla);
    
        // Crear una nueva instancia de Dompdf
        $pdf = new Dompdf(['enable_remote' => true]);
    
        // Obtener el contenido HTML de la plantilla
        $html = view($plantilla->ruta, [
            'datos' => $this->getDatosPlantilla($plantilla),
        ])->render();
    
        // Cargar el contenido HTML en Dompdf
        $pdf->loadHtml($html);
    
        // Establecer el tamaño y la orientación de la página
        $pdf->setPaper($plantilla->tamano, $plantilla->orientacion);
    
        // Renderizar el PDF
        $pdf->render();
    
        // Obtener el nombre del archivo
        $filename = $plantilla->nombre.'.pdf';
    
        // Descargar el archivo PDF generado
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }
    
    // Función para obtener los datos que se van a utilizar en la plantilla
    private function getDatosPlantilla(Plantilla $plantilla): array
    {
        // Obtener los datos del usuario autenticado
        $user = Auth::user();
        $datosUsuario = [
            'name' => $user->name,
            'email' => $user->email,
        ];
    
        // Combinar los datos del usuario con los datos de la plantilla
        return array_merge($datosUsuario, $plantilla->datos);
    }
}
