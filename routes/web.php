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
use App\Http\Controllers\CustomerAccessController;




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
Route::get('/Search_Sprint_for_Modulo/{id}', [SearchesController::class,'search_sprint_for_modulo'])->name('search_sprint_for_modulo');
Route::get('/search_presupuesto/{id}', [SearchesController::class,'search_presupuesto'])->name('search_presupuesto');
Route::get('/search_egresos/{id}', [SearchesController::class,'search_egresos'])->name('search_egresos');


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
Route::get('/Visor_PDF', [MatrizController::class,'visor_pdf'])->name('visor_pdf');

//documetnacion
Route::get('/Documents', [DocumentosController::class,'vista_documentos'])->name('documentos');
Route::post('/Save_documents', [DocumentosController::class,'guardar_documento'])->name('guardar_documentos');
Route::get('/Documents/{uuid}/download', [DocumentosController::class,'descargar_documento'])->name('descargar_documento');
Route::delete('/Documents/{id}/delete', [DocumentosController::class,'delete_doc'])->name('eliminar_documento');

//grabaciones
Route::get('/Grabaciones', [GrabacionesController::class,'vista_videos'])->name('videos');
Route::post('/Save_grabaciones', [GrabacionesController::class,'guardar_grabaciones'])->name('guardar_link');
Route::delete('/grabaciones/{id}/delete', [GrabacionesController::class,'delete_link'])->name('eliminar_link');

//uxs
Route::get('/UXS', [UXController::class,'vista_ux'])->name('ux');
Route::post('/saveUx', [UXController::class,'guardar_ux'])->name('guardar_ux');
Route::get('/ux/{uuid}/download', [UXController::class,'descargar_ux'])->name('descargar_ux');
Route::delete('/ux/{id}/delete', [UXController::class,'delete_ux'])->name('eliminar_ux');

//uis
Route::get('/UIS', [UIController::class,'vista_ui'])->name('ui');
Route::post('/saveui', [UIController::class,'guardar_ui'])->name('guardar_ui');
Route::get('/ui/{uuid}/download', [UIController::class,'descargar_ui'])->name('descargar_ui');
Route::delete('/ui/{id}/delete', [UIController::class,'delete_ui'])->name('eliminar_ui');

//presupuesto
Route::get('/Presupuesto', [PresupuestoController::class,'vista_presupuesto'])->name('presupuesto');
Route::post('/guardarPresupuesto', [PresupuestoController::class,'save_presupuesto'])->name('guardar_presupuesto');
Route::post('/actualizar_presupuesto', [PresupuestoController::class,'actualizar_presupuesto'])->name('actualizar_presupuesto');
Route::get('/pdf_presupusto', [PresupuestoController::class,'pdf_presupusto'])->name('pdf_presupusto');

//check list
Route::get('/Check_List', [CheckController::class,'vista_check_list'])->name('check_list');
Route::post('/Guardar_Preguntas', [CheckController::class,'guardar_preguntas'])->name('guardar_preguntas');
Route::post('/Generar_Link', [CheckController::class,'generar_link'])->name('generar_link');
Route::post('/Actualizar_Link', [CheckController::class,'actualizar_link'])->name('actualizar_link');
Route::get('/PDF_Check_List', [CheckController::class,'PDF_check_list'])->name('PDF_check_list');
Route::delete('/Eliminar_Check_List', [CheckController::class,'eliminar_check_list'])->name('eliminar_check_list');

//Customer Access
Route::get('/Check_List_Question/{id_link}', [CustomerAccessController::class,'encuesta_check_list'])->name('encuesta_check_list');
Route::post('/Envio_Cliente', [CustomerAccessController::class,'envio_cliente'])->name('envio_cliente');
Route::get('/Question_Ok', [CustomerAccessController::class,'gracias_contestar'])->name('gracias_contestar');