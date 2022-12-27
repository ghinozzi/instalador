<?php

namespace Ghinozzi\Instalador\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ghinozzi\Instalador\Services\InstaladorService;

class InstaladorController extends Controller
{
    public function index()
    {
        $tables = InstaladorService::getTablesColumns();
        $foreignKeys = InstaladorService::getForeignSchema();

        return view('instalador::index', compact('tables', 'foreignKeys'));
    }

    //AJAX
    public function getColumnsTable(Request $request)
    {
        $columns = DB::select('desc ' . $request->table . ';');
        return response()->json($columns);
    }


    public function create(Request $request)
    {
        //crud
        $gerarRoutes = false;

        //GeraModelos
        if (!empty($request->models)) {
            $gerarRoutes = true;
            foreach ($request->models as $table => $condition) {
                if ($condition) {
                    InstaladorService::generateModel($table, array_keys($request->table[$table]));
                }
            }
        }
        //GeraControllers
        if (!empty($request->controllers)) {
            $gerarRoutes = true;
            foreach ($request->controllers as $table => $condition) {
                if ($condition) {
                    InstaladorService::generateController($table, $request->table[$table]);
                }
            }
        }
        //GeraViews
        if (!empty($request->views)) {
            $gerarRoutes = true;
            foreach ($request->views as $table => $condition) {
                if ($condition) {
                    InstaladorService::generateRoute($table);
                    InstaladorService::generateViews($table, $request->table[$table], $request[$table]['singular'], $request[$table]['plural']);
                }
            }
        }
        //GeraRotas.

        if (!empty($request->menu)) {
            $gerarRoutes = true;
            foreach ($request->menu as $table => $condition) {
                if ($condition) {   
                    InstaladorService::generateMenuLink($table, $request[$table]['plural']);
                }
            }
        }

    }

    function upload(){
        
    }
}
