<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Str;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\File; 

class UXController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_ux(){
        $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->first();
        $uxs=DB::table('uxes')->select('*')->get();
        return view('UX.Ux',compact('proyectos','uxs'));
     }

     public function guardar_ux(Request $request){

        $request->validate([
            'nombre'=>'required',
            'clave' =>'required',
            'descripcion'=>'required',
            ]);

       $maxId = DB::table('uxes')->max('id');
        DB::statement('ALTER TABLE uxes AUTO_INCREMENT=' . intval($maxId + 1) . ';');
        $uuid = Str::uuid()->toString();

        if($request['archivo']!=null){
            $file = $request->file('archivo');
            $nombre = $file->getClientOriginalName();
            $nombre2 = time()."".$nombre;
            $destinationPath = public_path().'/save_ux';
          
        }else{
            $nombre2=null;
        
        }
        if($request['archivo']!=null){
            $file_image = $request->file('archivo');
            $file_image->move($destinationPath,$nombre2);
        }

            DB::table("uxes")->insert([
    
                "id_proyecto"=>$request['idpro'],
                "clave"=>$request['clave'],
                "nombre"=>$request['nombre'],
                "link"=>$request['link'],
                "archivo"=>$nombre2,
                "descripcion"=>$request['descripcion'],
                "uuid"=>$uuid,
    
            ]);
          
        return redirect()->back()->with(['message' => 'UX Guardado con Éxito', 'color' => 'success']);
}

public function descargar_ux($uuid){
    $doc=DB::table("uxes")->where('uuid',$uuid)->first();
    $pahtToFile=public_path("save_ux/". $doc->archivo);
    return response()->download($pahtToFile);
 }
 public function delete_ux($id){
    $doc=DB::table("uxes")->where('id',$id)->first();
    $pahtToFile=public_path("save_ux/". $doc->archivo);
    File::delete($pahtToFile);
   DB::table("uxes")->delete($id);
   return redirect()->back()->with(['message' => 'UX eliminado con Éxito', 'color' => 'success']);
 }

}
