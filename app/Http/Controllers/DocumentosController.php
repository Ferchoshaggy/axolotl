<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentosController extends Controller
{
    public function vista_documentos(){
        return view('Documentos.Documento');
     }
}
