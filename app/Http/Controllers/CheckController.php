<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;
class CheckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_check_list(){
        $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->first();

        if($proyectos==null){
            $id_proyecto=0;
        }else{
            $id_proyecto=$proyectos->id;
        }

        $modulos=DB::table("modulos")->where("id_proyecto",$id_proyecto)->get();
        $sprints=DB::table("sprints")->select("*")->get();
        $check_lists=DB::table("check_lists")->select("*")->get();
        $links=DB::table("links_check_lists")->where("id_proyecto",$id_proyecto)->first();
        return view('CheckList.CheckList',compact('proyectos','modulos','sprints','check_lists','links'));
    }

    public function guardar_preguntas(Request $request){

        for($i=0;$i<=$request['cantidad_select'];$i++){

            DB::table("check_lists")->insert([

                "prueba"=>$request['prueba'][$i],
                "tipo"=>$request['tipo_prueba'],
                "caracteristicas"=>$request['caracteristicas'][$i],
                "id_modulo"=>$request['Modulo'.$i],
                "id_sprint"=>$request['sprint'.$i],
                "id_proyecto"=>Auth::user()->id_proyecto_select
            ]);
        }

        if($request['tipo_prueba']==1){
            $texto="Prueba Funcional Guardada con Éxito";
            $tipo=1;
        }
        if($request['tipo_prueba']==2){
            $texto="Prueba No Funcional Guardada con Éxito";
            $tipo=2;
        }
        if($request['tipo_prueba']==3){
            $texto="Prueba Seguridad Guardada con Éxito";
            $tipo=3;
        }

        return redirect()->back()->with(['message' => $texto, 'color' => 'success','tipo_menu' => $tipo]);
    }

    public function generar_link(){

        DB::table("links_check_lists")->insert([
            "id_proyecto"=>Auth::user()->id_proyecto_select,
            "estado"=>"activo",
            "contestado"=>"no"
        ]);
        return redirect()->back()->with(['message' => 'Link Creado con exito', 'color' => 'success','tipo_menu' => '4']);
    }

    public function actualizar_link(Request $request){

        DB::table("links_check_lists")->where("id_proyecto",Auth::user()->id_proyecto_select)->update([
            "estado"=>$request['activador'],
            "contestado"=>"no"
        ]);
        return redirect()->back()->with(['message' => 'Link Actualizado con exito', 'color' => 'warning','tipo_menu' => '4']);
    }

    public function PDF_check_list(){

        $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->first();
        if($proyectos==null){
            $id_proyecto=0;
        }else{
            $id_proyecto=$proyectos->id;
        }
        $check_lists=DB::table("check_lists")->where("id_proyecto",$id_proyecto)->get();
        $pdf = PDF::loadView('CheckList.CheckList_PDF',compact('proyectos','check_lists'))->setPaper(array(0,0,956,1238));
        $nombre_pdf="Check Lists_".$proyectos->nombre.".pdf";
        return $pdf->stream($nombre_pdf);
    }

    public function eliminar_check_list(Request $request){

        DB::table("check_lists")->delete($request['id_check_list']);

        if($request['tipo_prueba_e']==1){
            $texto="Prueba Funcional Eliminada con Éxito";
            $tipo=1;
        }
        if($request['tipo_prueba_e']==2){
            $texto="Prueba No Funcional Eliminada con Éxito";
            $tipo=2;
        }
        if($request['tipo_prueba_e']==3){
            $texto="Prueba Seguridad Eliminada con Éxito";
            $tipo=3;
        }

        return redirect()->back()->with(['message' => $texto, 'color' => 'danger','tipo_menu' => $tipo]);
    }
}
