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
        $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->get();
        return view('Grabaciones.Video',compact('proyectos'));
     }
}
