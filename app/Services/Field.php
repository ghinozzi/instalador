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

    function getFieldHtml($type,$variavel = null){
        $html = "";
        $html .= "<div class='form-group pt-2'> \n";
        $html .= "<label for='".$this->name."' class='fs-5 fw-bold mb-2'>".$this->title."</label> \n";
        if($type == 'create'){
            $html .= "<input type='text' name='".$this->name."' id='".$this->name."' class='form-control form-control-solid' placeholder='".$this->name."'> \n";
        }else if($type == 'edit'){
            $html .= "<input type='text' value='{{\$".$variavel."->".$this->name."}}' name='".$this->name."' id='".$this->name."' class='form-control form-control-solid' placeholder='".$this->name."'> \n";
        }
        $html .= "</div> \n";
        return $html;
    }

}
