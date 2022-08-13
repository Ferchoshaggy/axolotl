<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Str;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\File; 


class UIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_ui(){
        $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->first();
        $uis=DB::table("uis")->select('*')->get();
        return view('UI.Ui',compact('proyectos','uis'));
     }
     public function guardar_ui(Request $request){

        $request->validate([
            'nombre'=>'required',
            'clave' =>'required',
            'descripcion'=>'required',
            ]);

       $maxId = DB::table('uis')->max('id');
        DB::statement('ALTER TABLE uis AUTO_INCREMENT=' . intval($maxId + 1) . ';');
        $uuid = Str::uuid()->toString();

        if($request['archivo']!=null){
            $file = $request->file('archivo');
            $nombre = $file->getClientOriginalName();
            $nombre2 = time()."".$nombre;
            $destinationPath = public_path().'/save_ui';
          
        }else{
            $nombre2=null;
        
        }
        if($request['archivo']!=null){
            $file_image = $request->file('archivo');
            $file_image->move($destinationPath,$nombre2);
        }

            DB::table("uis")->insert([
    
                "id_proyecto"=>$request['idpro'],
                "clave"=>$request['clave'],
                "nombre"=>$request['nombre'],
                "link"=>$request['link'],
                "archivo"=>$nombre2,
                "descripcion"=>$request['descripcion'],
                "uuid"=>$uuid,
    
            ]);
          
        return redirect()->back()->with(['message' => 'UI Guardado con Éxito', 'color' => 'success']);
}
public function descargar_ui($uuid){
    $doc=DB::table("uis")->where('uuid',$uuid)->first();
    $pahtToFile=public_path("save_ui/". $doc->archivo);
    return response()->download($pahtToFile);
 }
 public function delete_ui($id){
    $doc=DB::table("uis")->where('id',$id)->first();
    $pahtToFile=public_path("save_ui/". $doc->archivo);
    File::delete($pahtToFile);
   DB::table("uis")->delete($id);
   return redirect()->back()->with(['message' => 'UI eliminado con Éxito', 'color' => 'success']);
 }
}
