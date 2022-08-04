<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_documentos(){
        return view('Documentos.Documento');
     }
}
