<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Services\InstaladorService;

class InstaladorController extends Controller
{
    public function index(){

        $tables = InstaladorService::getTablesColumns();

        /* dd($tables); */
        return view('instalador.index',compact('tables'));
    }

    //AJAX
    public function getColumnsTable(Request $request){
        $columns = DB::select('desc '.$request->table.';');
        return response()->json($columns);
    }


    public function create(Request $request){
        //crud
        $gerarRoutes = false;

        //GeraModelos
        if(!empty($request->models)){
            $gerarRoutes = true;
            foreach($request->models as $table => $condition){
                if($condition){
                    InstaladorService::generateModel($table,array_keys($request->table[$table]));
                }
            }
        }
        //GeraControllers
        if(!empty($request->controllers)){
            $gerarRoutes = true;
            foreach($request->controllers as $table => $condition){
                if($condition){
                    InstaladorService::generateController($table);
                }
            }
        }
        //GeraViews
        if(!empty($request->views)){
            $gerarRoutes = true;
            foreach($request->views as $table => $condition){
                if($condition){
                    InstaladorService::generateViews($table,$request->table[$table],$request->singular,$request->plural);
                }
            }
        }
         //GeraRotas.

         //verificarFuncionamento
        if(!empty($request->views) || !empty($request->controllers) || !empty($request->models)){
            $gerarRoutes = true;
            foreach($request->table as $table => $condition){
                if($condition){
                    InstaladorService::generateRoute($table);
                    InstaladorService::generateMenuLink($table,$request->plural);
                }
            }
        }

    }
}
