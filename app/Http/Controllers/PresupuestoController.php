<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use DateTime;

class PresupuestoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_presupuesto(){
        $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->first();
        $presupuestos=DB::table('presupuestos')->select('*')->get();
        $modulos=DB::table("modulos")->where('id_proyecto',Auth::user()->id_proyecto_select)->get();
        $sprints=DB::table("sprints")->select("*")->get();

        //opereaciones para mostrar
        $pre=DB::table('presupuestos')->where('id_proyecto',Auth::user()->id_proyecto_select)->first();
        $egresosD=DB::table('dinamico_egresos')->where('id_presupuesto',$pre->id)->selectRaw('sum(egreso) as egresos')->first();
        
        $costoD=($pre->costo * $pre->sprints);

        $totalEgresos=($pre->egreso + $egresosD->egresos);
        $gananciaI=round(($pre->costo - $totalEgresos) / $pre->integrantes,2);
        

        //sacar semanas de una fecha a otra
        $fecha1 = new DateTime($proyectos->fecha);
        $fecha2 = new DateTime($proyectos->entrega);
        $semanas= $fecha1->diff($fecha2);
        $calcular=floor($semanas->format('%a') / 7);

        //ganancias semanal
        $gananciaS=round($gananciaI / $calcular);
      

       return view('Presupuestos.Presupuesto',compact('proyectos','presupuestos','modulos','sprints','calcular','costoD','totalEgresos','gananciaI','gananciaS'));
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
}
