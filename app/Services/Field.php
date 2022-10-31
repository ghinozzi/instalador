<?php

namespace App\Services;

class Field
{
    protected $typeFields = [
        'texto pequeno',
        'texto longo',
        'editor html',
        'numero',
        'cpf',
        'cnpj',
        'data',
        'dinheiro',
        'arquivo',
        'imagem'];

    protected $name;
    protected $title;
    protected $type;

    function __construct($name,$title,$type = null){
        $this->name = $name;
        $this->title = $title;
        $this->type = $type;
    }

    function getTableHeader(){
        return "<th>".$this->title."</th>";
    }

    function getTableField(){
        return "<td>{{\$d->".$this->name."}}</td>";
    }

}
