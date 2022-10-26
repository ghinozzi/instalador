<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InstaladorController extends Controller
{
    public function index(){

        $show_tables = DB::select('show tables;');
        foreach($show_tables as $table){
            $table = $table[array_key_first($table=(array)$table)];
            $show_column = DB::select('desc '.$table.';');
            //var_dump($show_column);
            $column = [];
            foreach($show_column as $coluna){
                $column[] = [
                    "name" => $coluna->Field,
                    "type" => $coluna->Type,
                    "Key" => $coluna->Key
                ];
            }
            $tables[] = [
                "table"=>$table,
                "column"=>$column
            ];
        }

        /* dd($tables); */
        return view('instalador.index',compact('tables'));
    }


    public function getColumnsTable(Request $request){
        $columns = DB::select('desc '.$request->table.';');

        return response()->json($columns);
    }
}
