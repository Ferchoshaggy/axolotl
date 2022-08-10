<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\File; 

class DocumentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_documentos(){
        $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->first();
        $documentos=DB::table("documentos")->select("*")->get();
        return view('Documentos.Documento',compact('proyectos','documentos'));
     }

     public function guardar_documento(Request $request){

        $request->validate([
            'fecha'=>'required',
            'descripcion' =>'required',
            'archivo'=>'required',
            ]);

       $maxId = DB::table('documentos')->max('id');
        DB::statement('ALTER TABLE documentos AUTO_INCREMENT=' . intval($maxId + 1) . ';');

        if($request['archivo']!=null){
            $file = $request->file('archivo');
            $nombre = $file->getClientOriginalName();
            $nombre2 = time()."".$nombre;
            $destinationPath = public_path().'/save_doc';
            $uuid = Str::uuid()->toString();
        }else{
            $nombre=null;
            $nombre2=null;
        }
        if($request['archivo']!=null){
            $file_image = $request->file('archivo');
            $file_image->move($destinationPath,$nombre2);
        }

            DB::table("documentos")->insert([
    
                "id_proyecto"=>$request['idpro'],
                "nombre"=>$nombre,
                "fecha"=>$request['fecha'],
                "archivo"=>$nombre2,
                "descripcion"=>$request['descripcion'],
                "uuid"=>$uuid,
    
            ]);
          
        return redirect()->back()->with(['message' => 'Documento Guardado con Éxito', 'color' => 'success']);

     }
     
     public function descargar_documento($uuid){
        $doc=DB::table("documentos")->where('uuid',$uuid)->first();
        $pahtToFile=public_path("save_doc/". $doc->archivo);
        return response()->download($pahtToFile);
     }

     public function delete_doc($id){
        $doc=DB::table("documentos")->where('id',$id)->first();
        $pahtToFile=public_path("save_doc/". $doc->archivo);
        File::delete($pahtToFile);
       DB::table("documentos")->delete($id);
       return redirect()->back()->with(['message' => 'Documento eliminado con Éxito', 'color' => 'success']);
     }

}
