<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_check_list(){
        return view('CheckList.CheckList');
     }
}
