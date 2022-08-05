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
        return view('UX.Ux',compact('proyectos'));
     }
}
