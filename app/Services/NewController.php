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
        $codigo = file_get_contents(app_path().DIRECTORY_SEPARATOR.'Generator'.DIRECTORY_SEPARATOR.'Controller'.DIRECTORY_SEPARATOR.'Controller.php');


        $relations = $this->relations();
        $replaces = [
            'NomeModel'=> $this->nomeModel,
            'NomePasta'=> $this->nomePasta,
            'NomeVariavel'=> $this->nomeVariavel,
            'Relations'=> $relations['relations'],
            'Compact' => $relations['compact'],
            'Uses'=>$relations['uses']
        ];
        $codigo = Utils::replaceContents($codigo,$replaces);//erro aqui
        if(file_put_contents(app_path().DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.$this->nomeModel."Controller.php", $codigo)){
            return true;
        };
    }
    protected function relations(){
        $foreignKeys = InstaladorService::getForeignSchema();

        $codigo = null;
        $uses = null;
        $compact = [];
        if(!empty($foreignKeys[$this->tabela])){
            foreach($foreignKeys[$this->tabela] as $fk){
                if(!empty($this->campos[$fk->fk]['referencia'])){
                    $codigo .= "\$select_".$fk->fk." = ".ucfirst($fk->reftable)."::orderBy('".$this->campos[$fk->fk]['referencia']."','asc')->get(); \n";
                    $compact[] = "\"select_".$fk->fk."\"";
                    $uses .= "use App\\Models\\".ucfirst($fk->reftable)."; \n";
                }
            }
        }

        if(!empty($compact)){
            $compact = ",compact(".implode(',',$compact).")";
        }else{
            $compact = "";
        }

        return ['relations'=> $codigo,'compact'=>$compact,'uses'=>$uses];
    }


}
