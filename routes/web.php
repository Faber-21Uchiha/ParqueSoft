<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/admin/login');
Route::get('/plantilla', function () {
    return view('plantilla');
});
Route::get('/generar-pdf', function () {
    require_once(public_path() . '/generar-pdf.php');
});

use Laravel\Telescope\Http\Controllers\HomeController;

Route::get('/telescope', [HomeController::class, 'index']);

use App\Filament\Pages\InfEstudiantes;

Route::get('/inf-estudiantes', InfEstudiantes::class)->name('inf-estudiantes');
