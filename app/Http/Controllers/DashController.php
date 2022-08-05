<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
class DashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vista_dash(){
        $proyectos=DB::table("proyectos")->select("*")->get();
        return view('dash.index',compact('proyectos'));
    }

    public function guardar_proyecto(Request $request){
        echo $request;
        DB::table("proyectos")->insert([

            "nombre"=>$request['nombre_proyecto'],
            "entrega"=>$request['fecha_entrega'],
            "cliente"=>$request['cliente'],
            "contacto"=>$request['contacto'],
            "descripcion"=>$request['description_proyecto']

        ]);
        //para pasarlo al modelo o modelos
        $id = DB::getPdo()->lastInsertId();

        for ($i=0;$i<count($request['nombre_modulos']);$i++) { 
            
            DB::table("modulos")->insert([
                "id_proyecto"=>$id,
                "nombre"=>$request['nombre_modulos'][$i],
                "descripcion"=>$request['description_modulos'][$i]

            ]);
            
            //para pasarlo al sprint o sprint´s
            $id_2 = DB::getPdo()->lastInsertId();
            echo "<br>".$request['nombre_modulos'][$i]."<br>";
            for ($j=0;$j<count($request['nombre_sprints_'.$request['nombre_modulos'][$i]]);$j++) {
                echo $request['nombre_sprints_'.$request['nombre_modulos'][$i]][$j]."<br>";
                
                DB::table("sprints")->insert([
                    "id_modulo"=>$id_2,
                    "nombre"=>$request['nombre_sprints_'.$request['nombre_modulos'][$i]][$j],
                    "descripcion"=>$request['description_sprint_'.$request['nombre_modulos'][$i]][$j]

                ]);
                
            }

        }
        return redirect()->back()->with(['message' => 'Proyecto Guardado con Éxito', 'color' => 'success']);
    }

    public function seleccionar_proyecto(Request $request,$id)
    {
        DB::table("users")->where('id',Auth::user()->id)->update([

            "id_proyecto_select"=>$request['proyecto'],
            
        ]);
        
        return redirect()->back()->with(['selec' => 'Seleccionaste proyecto con exito', 'color' => 'success']);
    }
}
