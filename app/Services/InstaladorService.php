<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class InstaladorService
{

    static function getTablesColumns(){
        $show_tables = DB::select('show tables;');
        $table = [];
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
        return $tables;
    }

    static function generateModel($table, $campos){
        Try{
            $datas = "";
            $model = new NewModel($table,$campos);

            if($model->criar()){
                echo 'Model criado com sucesso';
            }
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    static function generateController($table){
        Try{
            $datas = "";
            $model = new NewController($table);

            if($model->criar()){
                echo 'Controller criado com sucesso';
            }
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    static function generateViews($table, $campos){
        echo "<br>Gerar view da tabela $table<br>";
        foreach($campos as $campo){
            echo "&nbsp&nbsp&nbsp&nbspGerar na view o campo: ".$campo."<br>";
        }
        echo "<br><br><br>";
        //Gerar Index
        /*
        if(file_put_contents(base_path().'\resources\\'.$table."\index.blade.php", $codigoIndex)){
            return true;
        };
        */

        //Gerar create


        //Gerar update

    }
}
