<?php

namespace Ghinozzi\Instalador\Services;

use Illuminate\Support\Facades\DB;

class InstaladorService
{

    static function getTablesColumns()
    {
        $show_tables = DB::select('show tables;');
        $tables = [];
        foreach ($show_tables as $table) {
            $table = $table[array_key_first($table = (array)$table)];
            $show_column = DB::select('desc ' . $table . ';');
            //var_dump($show_column);
            $column = [];
            foreach ($show_column as $coluna) {
                $column[] = [
                    "name" => $coluna->Field,
                    "type" => $coluna->Type,
                    "Key" => $coluna->Key
                ];
            }
            $tables[$table] = [
                "table" => $table,
                "column" => $column
            ];
        }
        return $tables;
    }

    static function getForeignSchema()
    {
        $schema = DB::select('SELECT DATABASE() AS db;');

        $foreignKeys = DB::select("SELECT table_name AS 'table',  column_name AS  'fk',
        referenced_table_name AS 'reftable', referenced_column_name  AS 'refpk'
        FROM information_schema.key_column_usage
        WHERE referenced_table_name IS NOT NULL
        AND TABLE_SCHEMA='" . $schema[0]->db . "'");

        $response = [];
        foreach ($foreignKeys as $f):
            $response[$f->table][$f->fk] = $f;
        endforeach;

        return $response;
    }

    static function getPrimaryKey($table)
    {
        $primary_key = DB::select("SELECT column_name as c FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=? AND column_key = 'PRI' AND table_name=?", [
            env('DB_DATABASE'),
            $table
        ]);

        return $primary_key[0]->c;
    }

    static function generateModel($table, $campos)
    {
        try {
            $datas = "";
            $model = new NewModel($table, $campos);

            if ($model->criar()) {
                echo 'Model criado com sucesso!<br>';
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    static function generateController($table, $campos)
    {
        try {
            $datas = "";
            $model = new NewController($table, $campos);

            if ($model->criar()) {
                echo 'Controller criado com sucesso<br>';
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    static function generateViews($table, $campos, $singular, $plural)
    {
        try {
            $model = new NewView($table, $campos, $singular, $plural, self::getPrimaryKey($table));

            if ($model->criarIndex()) {
                echo 'Index criado com sucesso<br>';
            }
            if ($model->criarCreate()) {
                echo 'Create criado com sucesso<br>';
            }
            if ($model->criarEdit()) {
                echo 'Edit criado com sucesso<br>';
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    static function generateRoute($table)
    {
        try {
            $route = new NewRoute($table);

            if ($route->criar() == TRUE) {
                echo 'Route criada com sucesso!<br>';
            } else {
                echo 'Route j?? existe!<br>';
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    static function generateMenuLink($table, $plural)
    {
        try {
            $MenuLink = new NewMenuLink($table, $plural);

            if ($MenuLink->criar() == TRUE) {
                echo 'Menu-link criado com sucesso!<br>';
            } else {
                echo 'Menu-link j?? existe!<br>';
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
