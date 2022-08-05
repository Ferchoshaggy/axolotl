<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;

class DocumentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_documentos(){
        $proyectos=DB::table("proyectos")->where('id',Auth::user()->id_proyecto_select)->get();
        return view('Documentos.Documento',compact('proyectos'));
     }
}
