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
    public function create(Request $request){
        $show_tables = DB::select('show tables;');
        $errors = [];
        foreach($show_tables as $table){
            $table = $table[array_key_first($table=(array)$table)];
            $show_column = DB::select('desc '.$table.';');
            $model = $controller = $view = false;
            //verificar qual opção foi marcada  para gerar os arquivos
                if($request->input($table."model")){
                    $model = true;
                }
                if($request->input($table."controller")){
                    $controller = true;
                }
                if($request->input($table."view")){
                    $view = true;
                }
            //
            if(($model == false)&&($controller == false)&&($view == false)){//ignorar tabela que nao tiver os checkbox marcados e gravar erro
                $errors[] = "Não há opção selecionada para gerar arquivos na tabela $table";
            }else{
                $campos = [];//iniciando variavel para o processo
                foreach($show_column as $coluna){
                    if(!empty($request->input('type-' . $table . '-' . $coluna->Field))){
                        $field = $request->input('type-' . $table . '-' . $coluna->Field);
                        if($field != "Selecione"){
                            if($field == "select"){
                                if(!empty($request->input('relation-table-' . $table . '-' . $coluna->Field))){
                                    $relation_table = $request->input('relation-table-' . $table . '-' . $coluna->Field);
                                    if(!empty($request->input('relation-column-' . $table . '-' . $coluna->Field))){
                                        $relation_column = $request->input('relation-column-' . $table . '-' . $coluna->Field);
                                        //echo "<br>O campo: $coluna->Field, é do tipo: $field, e é relacionada com a tabela: $relation_table, e com a coluna: $relation_column";
                                        $campos[] = [
                                            'tableName'=>"$table",
                                            "name"=> $coluna->Field,
                                            "Field"=>$field,
                                            "relation_table"=>$relation_table,
                                            "relation_column"=>$relation_column
                                        ]; 
                                    }else{
                                        $errors[] = "Na tabela $table a coluna $coluna->Field é do tipo select mas nao possui um campo selecionado";
                                    }
                                }else{
                                    $errors[] = "Na tabela $table a coluna $coluna->Field é do tipo select mas nao possui uma tabela relacionada";
                                }
                            }else{
                                $campos[] = [
                                    'tableName'=>"$table",
                                    "name"=> $coluna->Field,
                                    "Field"=>$field
                                ]; 
                            }
                        }
                    }
                }
            }
            if(!empty($campos)){
                if($model == true){
                    InstaladorController::generateModel($table, $campos);
                }
                if($controller == true){
                    InstaladorController::generateController($table, $campos);
                }
                if($view == true){
                    InstaladorController::generateViews($table, $campos);
                }
            }else{
                $errors[] = "A tabela $table está com a opção de gerar arquivos marcada mas não ha campos validos";
            }
        }
        echo "=====================================================================ERROS=====================================================================<br>";
        DD($errors);
    }
    
    static function generateModel($table, $campos){
        echo "<br>Gerar model da tabela $table<br>";
        foreach($campos as $campo){
            if(!empty($campo)){
                if(!empty($campo['relation_column'])){
                    echo "&nbsp&nbsp&nbsp&nbspGerar na model o campo: ".$campo['name']." relacionada com a tabela: ".$campo['relation_table']." e com a coluna: ".$campo['relation_column']."<br>";
                }else{
                    echo "&nbsp&nbsp&nbsp&nbspGerar na model o campo: ".$campo['name']."<br>";
                }   
            }    
        }
        echo "<br><br><br>";
    }

    static function generateController($table, $campos){
            echo "<br>Gerar controller da tabela $table<br>";
            foreach($campos as $campo){
                if(!empty($campo['relation_column'])){
                    echo "&nbsp&nbsp&nbsp&nbspGerar no controller o campo: ".$campo['name']." e com a coluna: ".$campo['relation_table']." coluna: ".$campo['relation_column']."<br>";
                }else{
                    echo "&nbsp&nbsp&nbsp&nbspGerar no controller o campo: ".$campo['name']."<br>";
                }       
            }
        
            echo "<br><br><br>";
    }

    static function generateViews($table, $campos){
        echo "<br>Gerar view da tabela $table<br>";
        foreach($campos as $campo){
            if(!empty($campo['relation_column'])){
                echo "&nbsp&nbsp&nbsp&nbspGerar no model o campo: ".$campo['name']." e com a coluna: ".$campo['relation_table']." coluna: ".$campo['relation_column']."<br>";
            }else{
                echo "&nbsp&nbsp&nbsp&nbspGerar no model o campo: ".$campo['name']."<br>";
            }       
        }
        echo "<br><br><br>";
    }
}
