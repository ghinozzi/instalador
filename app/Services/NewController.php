<?php

namespace App\Services;

use App\Services\Utils;

class NewController
{
    protected $nomeModel;
    protected $nomePasta;
    protected $nomeVariavel;

    public function __construct($tabela)
    {
        $this->nomeModel = ucfirst($tabela);
        $this->nomePasta = strtolower($tabela);
        $this->nomeVariavel = strtolower($tabela);
    }

    public function criar()
    {
        $codigo = file_get_contents(app_path().'\Generator\Controller\Controller.php');

        $replaces = [
            'NomeModel'=> $this->nomeModel,
            'NomePasta'=> $this->nomePasta,
            'NomeVariavel'=> $this->nomeVariavel
        ];

        $codigo = Utils::replaceContents($codigo,$replaces);

        if(file_put_contents(app_path().'\Http\Controllers\\'.$this->nomeModel."Controller.php", $codigo)){
            return true;
        };

    }
}
