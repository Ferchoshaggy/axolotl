<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AvanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
