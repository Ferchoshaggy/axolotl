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

//usuario config
Route::get('/Config_user', [UserController::class,'vista_user_edit'])->name('edit_user');
Route::post('/Actualizar_user', [UserController::class,'user_actualizar'])->name('user_actualizar');

//matris master
Route::get('/Matriz_Master', [MatrizController::class,'vista_matriz'])->name('matriz');

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