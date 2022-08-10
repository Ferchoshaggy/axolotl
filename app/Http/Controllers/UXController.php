<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UXController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_ux(){
        $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->get();
        $uxs=DB::table('uxes')->select('*')->get();
        return view('UX.Ux',compact('proyectos'));
     }

     public function guardar_ux(Request $request){

        $request->validate([
            'nombre'=>'required',
            'clave' =>'required',
            'archivo'=>'required',
            'descripcion'=>'required',
            ]);

       $maxId = DB::table('uxes')->max('id');
        DB::statement('ALTER TABLE uxes AUTO_INCREMENT=' . intval($maxId + 1) . ';');

        if($request['archivo']!=null){
            $file = $request->file('archivo');
            $nombre = $file->getClientOriginalName();
            $nombre2 = time()."".$nombre;
            $destinationPath = public_path().'/save_doc';
            $uuid = Str::uuid()->toString();
        }else{
            $nombre=null;
            $nombre2=null;
            $uuid = null;
        }
        if($request['archivo']!=null){
            $file_image = $request->file('archivo');
            $file_image->move($destinationPath,$nombre2);
        }

            DB::table("uxes")->insert([
    
                "id_proyecto"=>$request['idpro'],
                "nombre"=>$nombre,
                "fecha"=>$request['fecha'],
                "archivo"=>$nombre2,
                "descripcion"=>$request['descripcion'],
                "uuid"=>$uuid,
    
            ]);
          
        return redirect()->back()->with(['message' => 'Documento Guardado con Éxito', 'color' => 'success']);
}
}
