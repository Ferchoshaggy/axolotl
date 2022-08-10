<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_ui(){
        $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->first();
        return view('UI.Ui',compact('proyectos'));
     }
}
