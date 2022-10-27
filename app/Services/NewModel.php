<?php

namespace App\Services;

use App\Services\Utils;

class NewModel
{
    protected $nomeModel;
    protected $campos;
    protected $datas;
    protected $tabela;

    public function __construct($tabela,$campos)
    {
        $this->tabela = $tabela;
        $this->nomeModel = ucfirst($tabela);
        $this->campos = $campos;
        $this->datas = "";
    }

    public function criar()
    {
        $codigo = file_get_contents(app_path().'\Generator\Models\Model.php');

        $campos = $this->fillableFieldsFormat($this->campos);
        $replaces = [
            'NomeModel'=> $this->nomeModel,
            'Campos'=> $campos,
            'Tabela'=> "'".$this->tabela."'",
            'Datas'=> "'".$this->datas."'"
        ];

        $codigo = Utils::replaceContents($codigo,$replaces);

        if(file_put_contents(app_path().'\Models\\'.$this->nomeModel.".php", $codigo)){
            return true;
        };

    }

    function fillableFieldsFormat($fields){
        return "'".implode("','",$fields)."'";
    }

}
