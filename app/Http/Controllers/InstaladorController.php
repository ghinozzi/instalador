<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InstaladorController extends Controller
{
    public function index(){

        $tabelas = DB::select('show tables;');

        return view('instalador.index',compact('tabelas'));
    }
}
