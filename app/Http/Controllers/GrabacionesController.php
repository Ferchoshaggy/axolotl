<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class GrabacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_videos(){
        $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->first();
        $grabaciones=DB::table('grabaciones')->select("*")->get();
        return view('Grabaciones.Video',compact('proyectos','grabaciones'));
     }
     public function guardar_grabaciones(Request $request){

        $request->validate([
            'link'=>'required',
            'fecha'=>'required',
            'descripcion' =>'required',
            ]);
            
        $maxId = DB::table('grabaciones')->max('id');
        DB::statement('ALTER TABLE grabaciones AUTO_INCREMENT=' . intval($maxId + 1) . ';');

            DB::table("grabaciones")->insert([
    
                "id_proyecto"=>$request['idpro'],
                "link"=>$request['link'],
                "fecha"=>$request['fecha'],
                "descripcion"=>$request['descripcion'],
            ]);
          
        return redirect()->back()->with(['message' => 'Grabacion Guardada con Éxito', 'color' => 'success']);
     }
     public function delete_link($id){
       DB::table("grabaciones")->delete($id);
       return redirect()->back()->with(['message' => 'Grabacion eliminada con Éxito', 'color' => 'success']);
     }


}
