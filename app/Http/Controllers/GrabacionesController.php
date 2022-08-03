<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GrabacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_videos(){
        return view('Grabaciones.Video');
     }
}
