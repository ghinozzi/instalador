<?php

namespace App\Dominio;

class Fields
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
    protected $type;

    function __construct($name,$type){
        $this->name = $name;
        $this->type = $type;
    }

}
