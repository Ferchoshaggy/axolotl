<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use DateTime;
use PDF;
class PresupuestoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_presupuesto(){

        $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->first();

        if($proyectos==null){
            $id_proyecto=0;
        }else{
            $id_proyecto=$proyectos->id;
        }
        $modulos=DB::table("modulos")->where('id_proyecto',$id_proyecto)->get();
        $presupuestos=DB::table('presupuestos')->where('id_proyecto',$id_proyecto)->get();
        $sprints=DB::table("sprints")->select("*")->get();
        $egresos= DB::table('dinamico_egresos')->select("*")->get();

        //sacar semanas de una fecha a otra
        if(isset($proyectos)){
            $fecha1 = new DateTime($proyectos->fecha);
            $fecha2 = new DateTime($proyectos->entrega);
            $semanas= $fecha1->diff($fecha2);
            $calcular=floor($semanas->format('%a') / 7);
           
            return view('Presupuestos.Presupuesto',compact('proyectos','presupuestos','modulos','sprints','calcular','egresos'));

        }else{

            return view('Presupuestos.Presupuesto',compact('proyectos','presupuestos','modulos','sprints'));
        }
    
        
    } 
    
     
     public function save_presupuesto(Request $request){
        $request->validate([
            'costo'=>'required',
            'integrantes'=>'required',
            'semanas' =>'required',
            'sprints' =>'required',
            'egreso' =>'required',
            'concepto' =>'required',
            ]);
            
        $maxId = DB::table('presupuestos')->max('id');
        DB::statement('ALTER TABLE presupuestos AUTO_INCREMENT=' . intval($maxId + 1) . ';');

            DB::table("presupuestos")->insert([
    
                "id_proyecto"=>$request['idpro'],
                "costo"=>$request['costo'],
                "integrantes"=>$request['integrantes'],
                "semanas"=>$request['semanas'],
                "sprints"=>$request['sprints'],
                "egreso"=>$request['egreso'],
                "concepto"=>$request['concepto'],
            ]);

            $idPRE = DB::getPdo()->lastInsertId();

            if(isset($request['egresos'])){
                for($i=0;$i<count($request['egresos']);$i++){
                
                DB::table("dinamico_egresos")->insert([

                    "id_presupuesto"=>$idPRE,
                    "egreso"=>$request['egresos'][$i],
                    "concepto"=>$request['conceptos'][$i],
                ]);
            }}
                
          
        return redirect()->back()->with(['message' => 'Presupuesto Guardado con Éxito', 'color' => 'success']);
     }

     public function actualizar_presupuesto(Request $request){
        $request->validate([
            'costo'=>'required',
            'integrantes'=>'required',
            'semanas' =>'required',
            'sprints' =>'required',
            'egreso' =>'required',
            'concepto' =>'required',
            ]);
            
            DB::table("presupuestos")->where("id",$request['id_presupuesto'])->update([
                "costo"=>$request['costo'],
                "integrantes"=>$request['integrantes'],
                "semanas"=>$request['semanas'],
                "sprints"=>$request['sprints'],
                "egreso"=>$request['egreso'],
                "concepto"=>$request['concepto'],
            ]);

            DB::table("dinamico_egresos")->where("id_presupuesto",$request['id_presupuesto'])->delete();

            if(isset($request['egresos'])){
                for($i=0;$i<count($request['egresos']);$i++){
                
                DB::table("dinamico_egresos")->insert([

                    "id_presupuesto"=>$request['id_presupuesto'],
                    "egreso"=>$request['egresos'][$i],
                    "concepto"=>$request['conceptos'][$i],
                ]);
            }}
                
          
        return redirect()->back()->with(['message' => 'Presupuesto Actualizado con Éxito', 'color' => 'warning']);
     }

     public function pdf_presupusto(){

        $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->first();

        if($proyectos==null){
            $id_proyecto=0;
        }else{
            $id_proyecto=$proyectos->id;
        }
        $modulos=DB::table("modulos")->where('id_proyecto',$id_proyecto)->get();
        $presupuestos=DB::table('presupuestos')->where('id_proyecto',$id_proyecto)->get();
        $sprints=DB::table("sprints")->select("*")->get();
        $egresos= DB::table('dinamico_egresos')->select("*")->get();

        //sacar semanas de una fecha a otra
        if(isset($proyectos)){
            $fecha1 = new DateTime($proyectos->fecha);
            $fecha2 = new DateTime($proyectos->entrega);
            $semanas= $fecha1->diff($fecha2);
            $calcular=floor($semanas->format('%a') / 7);

            $pdf = PDF::loadView('Presupuestos.Presupuesto_PDF',compact('proyectos','presupuestos','modulos','sprints','calcular','egresos'))->setPaper(array(0,0,1188,1536),"landscape");
            $nombre_pdf="Presupuesto_".$proyectos->nombre.".pdf";
            return $pdf->stream($nombre_pdf);

        }else{

            return view('Presupuestos.Presupuesto_PDF',compact('proyectos','presupuestos','modulos','sprints'));
        }

     }
}
