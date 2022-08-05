<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search_sprint($id){

        $s_sprint=DB::table("sprints")->where("id",$id)->first();
        return json_encode($s_sprint);
    }

    public function search_modulo($id){

        $s_modulo=DB::table("modulos")->where("id",$id)->first();
        return json_encode($s_modulo);
    }
}
