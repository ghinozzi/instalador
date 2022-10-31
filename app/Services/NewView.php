<?php

namespace App\Services;

use App\Services\Utils;
use App\Services\Field;

class NewView
{
    protected $fields;
    protected $table;
    protected $singular;
    protected $plural;
    protected $nomeVariavel;

    public function __construct($table,$fields,$singular,$plural)
    {
        $this->table = $table;
        $this->fields = $fields;
        $this->singular = $singular;
        $this->plural = $plural;
        $this->nomeVariavel = strtolower($table);

        //verifica se existe a pasta
        if(!is_dir(base_path()."\\resources\\views\\".$this->table)){
            mkdir(addslashes(resource_path("views".DIRECTORY_SEPARATOR.$this->table)),0755,true);
        }
    }

    public function criarIndex()
    {
        // Pega o codigo base do template
        $codigo = file_get_contents(app_path().'\Generator\Views\crud\index.blade.php');
        $replaces = [
            'TituloPlural'=>$this->plural,
            'TituloSingular'=>$this->singular,
            'Tabela'=> $this->table,
            'TableHeaders'=>$this->getTableHeaders($this->fields),
            'TableFields'=>$this->getTableFields($this->fields),
            'NomeVariavel'=>$this->nomeVariavel
        ];
        $codigo = Utils::replaceContents($codigo,$replaces);

        //cria o arquivo
        $path = addslashes(resource_path("views".DIRECTORY_SEPARATOR.$this->table.DIRECTORY_SEPARATOR.'index.blade.php'));
        if(file_put_contents($path, $codigo)){
            return true;
        };
    }

    public function criarCreate()
    {
        // Pega o codigo base do template
        $codigo = file_get_contents(app_path().'\Generator\Views\crud\create.blade.php');
        $replaces = [
            'TituloSingular'=>'',
            'Tabela'=>'',
            'Campos'=>''
        ];
        $codigo = Utils::replaceContents($codigo,$replaces);

        //cria o arquivo
        if(file_put_contents(base_path()."\resources\views\\".$this->table."\create.blade.php", $codigo)){
            return true;
        };
    }

    public function criarEdit()
    {
        // Pega o codigo base do template
        $codigo = file_get_contents(app_path().'\Generator\Views\crud\edit.blade.php');
        $replaces = [
            'TituloSingular'=>'',
            'Tabela'=>'',
            'NomeVariavel'=>'',
            'CamposUpdate'=>''
        ];
        $codigo = Utils::replaceContents($codigo,$replaces);

        //cria o arquivo
        if(file_put_contents(base_path()."\resources\views\\".$this->table."\index.edit.php", $codigo)){
            return true;
        };
    }

    protected function getTableHeaders($fields){

        $headers = "";
        foreach($fields as $name => $f):
            $field = new Field($name,$f['title']);
            $headers.= $field->getTableHeader()."\n";
        endforeach;

        return $headers;
    }
    protected function getTableFields($fields){
        $tableFields = "";
        foreach($fields as $name => $f):
            $field = new Field($name,$f['title']);
            $tableFields.= $field->getTableField()."\n";
        endforeach;
        return $tableFields;
    }

}
