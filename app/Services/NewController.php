<?php

namespace App\Services;

use App\Services\Utils;
use App\Services\InstaladorService;

class NewController
{
    protected $nomeModel;
    protected $nomePasta;
    protected $nomeVariavel;
    protected $tabela;

    public function __construct($tabela,$campos)
    {
        $this->campos = $campos;
        $this->tabela = $tabela;
        $this->nomeModel = ucfirst($tabela);
        $this->nomePasta = strtolower($tabela);
        $this->nomeVariavel = strtolower($tabela);
    }

    public function criar()
    {
        $codigo = file_get_contents(app_path().'\Generator\Controller\Controller.php');


        $relations = $this->relations();
        $replaces = [
            'NomeModel'=> $this->nomeModel,
            'NomePasta'=> $this->nomePasta,
            'NomeVariavel'=> $this->nomeVariavel,
            'Relations'=> $relations['relations'],
            'Compact' => $relations['compact']
        ];
        $codigo = Utils::replaceContents($codigo,$replaces);
        if(file_put_contents(app_path().'\Http\Controllers\\'.$this->nomeModel."Controller.php", $codigo)){
            return true;
        };
    }
    protected function relations(){
        $foreignKeys = InstaladorService::getForeignSchema();

        $codigo = null;
        $compact = [];
        if(!empty($foreignKeys[$this->tabela])){
            foreach($foreignKeys[$this->tabela] as $fk){
                $codigo .= "\$select_".$fk->fk." = ".ucfirst($this->tabela)."::orderBy('".$this->campos[$fk->fk]['referencia']."','asc')->get(); \n";
                $compact[] = "\"select_".$fk->fk."\"";
            }
        }

        if(!empty($compact)){
            $compact = implode(',',$compact);
        }

        return ['relations'=> $codigo,'compact'=>$compact];
    }


}
