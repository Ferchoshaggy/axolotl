<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UXController extends Controller
{
    public function vista_ux(){
        return view('UX.Ux');
     }
}
