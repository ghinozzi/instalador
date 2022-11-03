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
        $codigo = file_get_contents(app_path().DIRECTORY_SEPARATOR.'Generator'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'crud'.DIRECTORY_SEPARATOR.'index.blade.php');
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
        $codigo = file_get_contents(app_path().DIRECTORY_SEPARATOR.'Generator'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'crud'.DIRECTORY_SEPARATOR.'create.blade.php');
        $replaces = [
            'TituloSingular'=>$this->singular,
            'Tabela'=>$this->table,
            'Campos'=>$this->getFieldHtml($this->fields)
        ];
        $codigo = Utils::replaceContents($codigo,$replaces);

        //cria o arquivo
        $path = base_path().DIRECTORY_SEPARATOR."resources".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR.$this->table.DIRECTORY_SEPARATOR."create.blade.php";
        if(file_put_contents($path, $codigo)){
            return true;
        };
    }

    public function criarEdit()
    {
        // Pega o codigo base do template
        $codigo = file_get_contents(app_path().DIRECTORY_SEPARATOR.'Generator'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'crud'.DIRECTORY_SEPARATOR.'edit.blade.php');
        $replaces = [
            'TituloSingular'=>$this->singular,
            'Tabela'=>$this->table,
            'NomeVariavel'=>$this->nomeVariavel,
            'CamposUpdate'=>$this->getFieldHtml($this->fields,'edit',$this->nomeVariavel)
        ];
        $codigo = Utils::replaceContents($codigo,$replaces);

        //cria o arquivo
        if(file_put_contents(resource_path().DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR.$this->table.DIRECTORY_SEPARATOR."edit.blade.php", $codigo)){
            return true;
        };
    }

    protected function getTableHeaders($fields){
        $headers = "";
        foreach($fields as $name => $f):
            $field = new Field($name,$f);
            $headers.= $field->getTableHeader()."\n";
        endforeach;

        return $headers;
    }
    protected function getTableFields($fields){
        $tableFields = "";
        foreach($fields as $name => $f):
            $field = new Field($name,$f);
            $tableFields.= $field->getTableField()."\n";
        endforeach;
        return $tableFields;
    }

    protected function getFieldHtml($fields,$type = 'create',$nomeVariavel=null){
        $fieldHtml = "";
        foreach($fields as $name => $f):
            $field = new Field($name,$f);
            $fieldHtml.= $field->getFieldHtml($type,$nomeVariavel)."\n";
        endforeach;
        return $fieldHtml;
    }

}
