<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;

class MatrizController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

   public function vista_matriz(){


      $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->first();

      if($proyectos==null){
         $id_proyecto=0;
      }else{
         $id_proyecto=$proyectos->id;
      }

      $modulos=DB::table("modulos")->where("id_proyecto",$id_proyecto)->get();
      $sprints=DB::table("sprints")->select("*")->get();
      return view('MatrizM.Matriz',compact('proyectos','modulos','sprints'));
   }

   public function cambio_porcentaje(Request $request){

      DB::table("sprints")->where("id",$request['id_sprint'])->update([
         "porcentaje"=>$request['porcentaje']
      ]);

      return redirect()->back()->with(['message' => 'Porcentaje Cambiado con Éxito', 'color' => 'warning']);
   }

   public function actualizar_proyecto(Request $request){

      DB::table("proyectos")->where("id",Auth::user()->id_proyecto_select)->update([
         "nombre"=>$request['nombre_proyecto'],
         "entrega"=>$request['fecha_entrega'],
         "cliente"=>$request['cliente'],
         "contacto"=>$request['contacto'],
         "descripcion"=>$request['description_proyecto']
      ]);

      return redirect()->back()->with(['message' => 'Datos del Proyecto Actualizados con Éxito', 'color' => 'warning']);
   }


   public function actualizar_modulo(Request $request){

      DB::table("modulos")->where("id",$request['id_modulo_e'])->update([
         "nombre"=>$request['nombre_modulo_e'],
         "descripcion"=>$request['description_modulo_e']
      ]);

      return redirect()->back()->with(['message' => 'Datos del Modulo Actualizados con Éxito', 'color' => 'warning']);
   }

   public function agregar_modulos(Request $request){

      for ($i=0;$i<count($request['nombre_modulos']);$i++) { 
         
         DB::table("modulos")->insert([
             "id_proyecto"=>Auth::user()->id_proyecto_select,
             "nombre"=>$request['nombre_modulos'][$i],
             "descripcion"=>$request['description_modulos'][$i]

         ]);
         
         //para pasarlo al sprint o sprint´s
         $id_2 = DB::getPdo()->lastInsertId();
         //echo "<br>".$request['nombre_modulos'][$i]."<br>";
         for ($j=0;$j<count($request['nombre_sprints_'.$request['nombre_modulos'][$i]]);$j++) {
             //echo $request['nombre_sprints_'.$request['nombre_modulos'][$i]][$j]."<br>";
             
             DB::table("sprints")->insert([
                 "id_modulo"=>$id_2,
                 "nombre"=>$request['nombre_sprints_'.$request['nombre_modulos'][$i]][$j],
                 "descripcion"=>$request['description_sprint_'.$request['nombre_modulos'][$i]][$j]

             ]);
             
         }

      }

      return redirect()->back()->with(['message' => 'Modulos Agregados y Sprints con Éxito', 'color' => 'success']);
   }

   public function agregar_sprints(Request $request){

      //para pasarlo al sprint o sprint´s
      for ($j=0;$j<count($request['nombre_sprints_tx']);$j++) {
          
          DB::table("sprints")->insert([
              "id_modulo"=>$request['id_modulo_agrega_sprit'],
              "nombre"=>$request['nombre_sprints_tx'][$j],
              "descripcion"=>$request['description_sprint_tx'][$j]

          ]);
          
      }

      return redirect()->back()->with(['message' => 'Sprints Agregados con Éxito', 'color' => 'success']);
   }

   public function actualizar_sprint(Request $request){

      DB::table("sprints")->where("id",$request['id_sprint_e'])->update([
         "nombre"=>$request['nombre_sprint_e'],
         "descripcion"=>$request['description_sprint_e']
      ]);

      return redirect()->back()->with(['message' => 'Datos del Sprint Actualizados con Éxito', 'color' => 'warning']);
   }

   public function eliminar_modulo(Request $request){
      DB::table("modulos")->delete($request['id_modulo_delete']);
      return redirect()->back()->with(['message' => 'Modulo Eliminado con Éxito', 'color' => 'danger']);

   }

   public function eliminar_sprint(Request $request){
      DB::table("sprints")->delete($request['id_sprint_delete']);
      return redirect()->back()->with(['message' => 'Sprint Eliminado con Éxito', 'color' => 'danger']);
   }

   public function visor_pdf(){

      $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->first();
      if($proyectos==null){
         $id_proyecto=0;
      }else{
         $id_proyecto=$proyectos->id;
      }
      $modulos=DB::table("modulos")->where("id_proyecto",$id_proyecto)->get();
      $sprints=DB::table("sprints")->select("*")->get();
      $colors=DB::table("colors")->select("*")->get();
      $pdf = PDF::loadView('MatrizM.Visor_PDF',compact('proyectos','modulos','sprints','colors'))->setPaper(array(0,0,956,1238));
      $nombre_pdf="Matriz Master_".$proyectos->nombre.".pdf";
      return $pdf->stream($nombre_pdf);
      //return view('MatrizM.Visor_PDF',compact('proyectos','modulos','sprints','colors'));
     
   }
}
