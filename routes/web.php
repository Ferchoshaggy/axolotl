<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvanceController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\GrabacionesController;
use App\Http\Controllers\MatrizController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\UIController;
use App\Http\Controllers\UXController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\SearchesController;




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
    return view('auth.login');
});



//dash
Route::get('/dash', [DashController::class,'vista_dash'])->name('vista_dash');
Route::post('/guardar_proyecto', [DashController::class,'guardar_proyecto'])->name('guardar_proyecto');
Route::put('/selec_proy/{id}', [DashController::class,'seleccionar_proyecto'])->name('seleccionar_proyecto');

//searches
Route::get('/Search_Sprint/{id}', [SearchesController::class,'search_sprint'])->name('search_sprint');
Route::get('/Search_Modulo/{id}', [SearchesController::class,'search_modulo'])->name('search_modulo');

//avance
Route::get('/Avance', [AvanceController::class,'vista_avance'])->name('Avance');

//usuario config
Route::get('/Config_user', [UserController::class,'vista_user_edit'])->name('edit_user');
Route::post('/Actualizar_user', [UserController::class,'user_actualizar'])->name('user_actualizar');

//matris master
Route::get('/Matriz_Master', [MatrizController::class,'vista_matriz'])->name('matriz');
Route::post('/Cambio_Porcentaje', [MatrizController::class,'cambio_porcentaje'])->name('cambio_porcentaje');
Route::post('/actualizar_proyecto', [MatrizController::class,'actualizar_proyecto'])->name('actualizar_proyecto');
Route::post('/actualizar_modulo', [MatrizController::class,'actualizar_modulo'])->name('actualizar_modulo');
Route::post('/guardar_modulos', [MatrizController::class,'agregar_modulos'])->name('agregar_modulos');
Route::post('/agregar_sprints', [MatrizController::class,'agregar_sprints'])->name('agregar_sprints');
Route::post('/actualizar_sprint', [MatrizController::class,'actualizar_sprint'])->name('actualizar_sprint');
Route::delete('/eliminar_sprint', [MatrizController::class,'eliminar_sprint'])->name('eliminar_sprint');
Route::delete('/eliminar_modulo', [MatrizController::class,'eliminar_modulo'])->name('eliminar_modulo');

//documetnacion
Route::get('/Documentos', [DocumentosController::class,'vista_documentos'])->name('documentos');

//grabaciones
Route::get('/Grabaciones', [GrabacionesController::class,'vista_videos'])->name('videos');

//uxs
Route::get('/UXS', [UXController::class,'vista_ux'])->name('ux');

//uis
Route::get('/UIS', [UIController::class,'vista_ui'])->name('ui');

//presupuesto
Route::get('/Presupuesto', [PresupuestoController::class,'vista_presupuesto'])->name('presupuesto');

//check list
Route::get('/Check_List', [CheckController::class,'vista_check_list'])->name('check_list');