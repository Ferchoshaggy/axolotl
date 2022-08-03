<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresupuestoController extends Controller
{
    public function vista_presupuesto(){
        return view('Presupuestos.Presupuesto');
     }
}
