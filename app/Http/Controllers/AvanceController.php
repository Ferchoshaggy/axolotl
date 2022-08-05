<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AvanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vista_avance(){

        $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->first();

        if($proyectos==null){
            $id_proyecto=0;
        }else{
            $id_proyecto=$proyectos->id;
        }

        $modulos=DB::table("modulos")->where("id_proyecto",$id_proyecto)->get();
        $sprints=DB::table("sprints")->select("*")->get();
        return view('Avance.Avance',compact('proyectos','modulos','sprints'));
    }
}
