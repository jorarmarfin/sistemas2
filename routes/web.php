<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('login');
	//echo '<h3>Página en construcción</h3>';
});




//Auth::routes();

Auth::routes(["register" => false]);

Route::middleware(['auth'])->group(function () {
	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::get('aspirantes',[App\Http\Controllers\AspiranteController::class, 'index'])->name('aspirantes.index');
    Route::get('aspirantes/lista',[App\Http\Controllers\AspiranteController::class, 'index_lista'])->name('aspirantes.lista');
    Route::get('aspirantes/{id}/{edit}',[App\Http\Controllers\AspiranteController::class, 'edit'])->name('aspirantes.edit');
    Route::PATCH('aspirantes/validar/{id}',[App\Http\Controllers\AspiranteController::class, 'validar'])->name('aspirantes.validar');

	 //secciones
    Route::PATCH('fechas/secciones/{id}',[App\Http\Controllers\FechaInicioController::class, 'store_secciones'])->name('fechas_secciones.store');
    Route::get('config/fechas/horarios/{id}',[App\Http\Controllers\FechaInicioController::class, 'fecha_horario'])->name('fechas.horarios');

    Route::get('config/secciones',[App\Http\Controllers\SeccionesController::class, 'index'])->name('secciones.index');
    Route::get('config/secciones/lista',[App\Http\Controllers\SeccionesController::class, 'index_lista'])->name('secciones.lista');
    Route::get('config/secciones/crear',[App\Http\Controllers\SeccionesController::class, 'create'])->name('secciones.create');
    Route::get('config/secciones/{id}/edit',[App\Http\Controllers\SeccionesController::class, 'edit'])->name('secciones.edit');
    Route::post('config/secciones/correo/classroom',[App\Http\Controllers\SeccionesController::class, 'correo_classroom'])->name('secciones_correo.classroom');
    Route::get('config/secciones/{id}/foramto',[App\Http\Controllers\SeccionesController::class, 'formato_notas'])->name('foramto_notas.excel');
    Route::post('secciones',[App\Http\Controllers\SeccionesController::class, 'store'])->name('secciones.store');
    Route::PATCH('secciones/{id}',[App\Http\Controllers\SeccionesController::class, 'update'])->name('secciones.update');
	Route::get('config/secciones/alumno/{id}',[App\Http\Controllers\AlumnoController::class, 'seccion_alumno'])->name('secciones_alumno.create');
    Route::post('config/secciones/alumno/{id}',[App\Http\Controllers\AlumnoController::class, 'seccion_alumno_store'])->name('secciones_alumno.store');

	Route::get('config/secciones/notas/{id}',[App\Http\Controllers\SeccionesController::class, 'subir_notas'])->name('secciones.notas');
	Route::post('config/secciones/notas/{id}',[App\Http\Controllers\SeccionesController::class, 'subir_notas_store'])->name('secciones_notas.store');
    Route::post('config/secciones/notas',[App\Http\Controllers\SeccionesController::class, 'subir_notas_procesar'])->name('secciones_notas.procesar');
	Route::get('config/secciones/alumno/{id}',[App\Http\Controllers\AlumnoController::class, 'seccion_alumno'])->name('secciones_alumno.create');
    Route::post('config/secciones/alumno/{id}',[App\Http\Controllers\AlumnoController::class, 'seccion_alumno_store'])->name('secciones_alumno.store');

    //--Solicitudes---------------------
    Route::get('solicitudes/{id}',[App\Http\Controllers\SolicitudController::class, 'index'])->name('solicitudes.index');
    Route::get('solicitudes/lista/{id}',[App\Http\Controllers\SolicitudController::class, 'index_lista'])->name('solicitudes.lista');

    //--Bitacora---------
    Route::get('bitacora/{id}',[\App\Http\Controllers\BitacoraController::class,'index'])->name('bitacora.index');

});

Route::get('province/{departament}',[App\Http\Controllers\UbigeoController::class, 'province'])->name('province.index');
Route::get('district/{departament}/{province}',[App\Http\Controllers\UbigeoController::class, 'district'])->name('district.index');
