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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dash', function () {
        return view('dash.index');
    })->name('dash');
});

Route::get('/Matriz_Master', [MatrizController::class,'vista_matriz'])->name('matriz');
Route::get('/Documentos', [DocumentosController::class,'vista_documentos'])->name('documentos');
Route::get('/Grabaciones', [GrabacionesController::class,'vista_videos'])->name('videos');
Route::get('/UXS', [UXController::class,'vista_ux'])->name('ux');
Route::get('/UIS', [UIController::class,'vista_ui'])->name('ui');
Route::get('/Presupuesto', [PresupuestoController::class,'vista_presupuesto'])->name('presupuesto');