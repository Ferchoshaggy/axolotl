<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UXController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_ux(){
        return view('UX.Ux');
     }
}
