<?php

namespace App\Services;

class Field
{
    /*
    protected $typeFields = ['Texto','Anexo','Senha','Texto Longo','Editor Html',
        'Data', 'DateTime', 'Dinheiro', 'Número', 'Checkbox','SelectEnum','Senha'];
    */
    protected $name;
    protected $title;
    protected $notnull;
    protected $lista;
    protected $referencia;
    protected $type;

    function __construct($name,$parametros){
        $this->name = $name;
        $this->title = $parametros['title'];
        $this->notnull = (!empty($parametros['notnull']))?$parametros['notnull']:0;
        $this->lista = (!empty($parametros['lista']))?$parametros['lista']:0;
        $this->referencia = (!empty($parametros['referencia']))?$parametros['referencia']:'';
        $this->type = $parametros['type'];
    }

    function getTableHeader(){
        return "<th>".$this->title."</th>";
    }

    function getTableField(){
        return "<td>{{\$d->".$this->name."}}</td>";
    }

    function getFieldHtml($pageType,$variavel = null){
        $html = "";
        $html .= "<div class='form-group pt-2'> \n";
        $html .= "<label for='".$this->name."' class='fs-5 fw-bold mb-2'>".$this->title."</label> \n";
        $html .= $this->getField($pageType,$variavel);
        $html .= "</div> \n";
        return $html;
    }

    function getField($pageType,$variavel){
        if(empty($this->type)){
            $this->type = 'Texto';
        }
        $value = "";
        switch($this->type){
            case 'Texto':
                if($pageType == 'edit'){
                    $value = "value='{{\$".$variavel."->".$this->name."}}'";
                }
                $html = "<input type='text' ".$value."  name='".$this->name."' id='".$this->name."' class='form-control form-control-solid' placeholder='".$this->name."'> \n";
                return $html;
                break;
            case 'select':
                $html = "<select ".$value."  name='".$this->name."' id='".$this->name."' class='form-control form-control-solid'> \n";
                if(!empty($this->referencia)){
                $html .= "@foreach(\$select_".$this->name." as \$j) \n";
                $html .= "<option value='{{\$j->id}}'>{{\$j->".$this->referencia."}}</option> \n";
                $html .= "@endforeach \n";
                }
                $html .= "</select> \n";

                return $html;
                break;
            case 'Anexo':
                break;
            case 'Texto Longo':
                if($pageType == 'edit'){
                    $value = "{{\$".$variavel."->".$this->name."}}";
                }
                $html = "<textarea name='".$this->name."' id='".$this->name."' class='form-control form-control-solid' placeholder='".$this->name."'>".$value."</textarea> \n";
                return $html;
                break;
            case 'Editor Html':
                break;
            case 'Data':
                if($pageType == 'edit'){
                    $value = "value='{{\$".$variavel."->".$this->name."}}'";
                }
                $html = "<input type='date' ".$value."  name='".$this->name."' id='".$this->name."' class='form-control form-control-solid' placeholder='".$this->name."'> \n";
                return $html;
                break;
            case 'DateTime':
                if($pageType == 'edit'){
                    $value = "value='{{\$".$variavel."->".$this->name."}}'";
                }
                $html = "<input type='datetime-local' ".$value."  name='".$this->name."' id='".$this->name."' class='form-control form-control-solid' placeholder='".$this->name."'> \n";
                return $html;
                break;
            case 'Dinheiro':
                if($pageType == 'edit'){
                    $value = "value='{{\$".$variavel."->".$this->name."}}'";
                }
                $html = "<input type='text' ".$value."  name='".$this->name."' id='".$this->name."' class='form-control form-control-solid money' placeholder='".$this->name."'> \n";
                return $html;
                break;
            case 'Número':
                if($pageType == 'edit'){
                    $value = "value='{{\$".$variavel."->".$this->name."}}'";
                }
                $html = "<input type='number' ".$value."  name='".$this->name."' id='".$this->name."' class='form-control form-control-solid numero' placeholder='".$this->name."'> \n";
                return $html;
                break;
            case 'Checkbox':
                if($pageType == 'edit'){
                    $value = "{{\$".$variavel."->".$this->name." == 1 ?'checked':''}}";
                }
                $html = "<input type='checkbox' ".$value."  name='".$this->name."' id='".$this->name."'> \n";
                return $html;
                break;
            case 'SelectEnum':
                break;
            case 'Senha':
                if($pageType == 'create'){
                    $html = "<input type='password'  name='".$this->name."' id='".$this->name."' class='form-control form-control-solid' placeholder='".$this->name."'> \n";
                }else{
                    $html = "";
                }
                return $html;
                break;
        }
    }
}
