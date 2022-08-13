<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CustomerAccessController extends Controller
{
    //

    public function encuesta_check_list($id){

        $datos=DB::table("links_check_lists")->where("id",$id)->first();

        if($datos!=null){

            $proyectos=DB::table("proyectos")->where('id',$datos->id_proyecto)->first();

            if($proyectos==null){
                $id_proyecto=0;
            }else{
                $id_proyecto=$proyectos->id;
            }

            $check_lists=DB::table("check_lists")->where("id_proyecto",$datos->id_proyecto)->get();

            return view('CustomerAccess.CustomerAccess_check_list',compact('proyectos','check_lists','datos'));
        }else{
            return view('CustomerAccess.CustomerAccess_sin_link');
        }
        
    }

    public function envio_cliente(Request $request){

        $dato=DB::table("check_lists")->where("id",$request['ids'][0])->first();

        DB::table("links_check_lists")->where("id_proyecto",$dato->id_proyecto)->update([
            "contestado"=>"si"
        ]);

        for ($i=0; $i < count($request['ids']); $i++) { 

            if($request['check'.$request['ids'][$i]]=="Si"){
                $obs=null;
            }else{
                $obs=$request['observaciones'.$request['ids'][$i]];
            }
            
            DB::table("check_lists")->where("id",$request['ids'][$i])->update([
                "funciona"=>$request['check'.$request['ids'][$i]],
                "observaciones"=>$obs
            ]);
        }
        return redirect()->back();
    }
}
