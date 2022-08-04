<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vista_ui(){
        return view('UI.Ui');
     }
}
