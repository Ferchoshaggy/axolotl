<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatrizController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

   public function vista_matriz(){
      return view('MatrizM.Matriz');
   }
}
