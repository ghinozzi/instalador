<?php

namespace App\Services;

use App\Services\Utils;

class NewRoute
{
    protected $tabela;
    protected $nomeVariavel;
    public function __construct($tabela){
        $this->tabela = $tabela;
        $this->nomeVariavel = strtolower($tabela);;
    }
    public function criar(){
        $layoutRoute = file_get_contents(app_path().DIRECTORY_SEPARATOR.'GeneratorLayout'.DIRECTORY_SEPARATOR.'Route.php');
        $replaces = [
            'TableName'=> $this->tabela,
            'ModelName'=> ucfirst($this->tabela),
            'NomeVariavel'=> $this->nomeVariavel
        ];
        $layoutRoute = Utils::replaceContents($layoutRoute,$replaces);
        $routefile = file_get_contents(base_path().'\routes\web.php');
        $referenceLineInRoute = 'use Illuminate\Support\Facades\Route;';//coloca a nova referencia após essa referencia <---
        $ControllerUse = "use App\Http\Controllers\\".ucfirst($this->tabela)."Controller;";

        if (!mb_strpos($routefile, $layoutRoute)) {
            $routefile = $routefile . $layoutRoute;
        }

        if (!mb_strpos($routefile, $ControllerUse)) {//verifica o controller foi devidamente referenciada na route
            $routefile = str_replace($referenceLineInRoute, $referenceLineInRoute."\r\n$ControllerUse", $routefile);
        }else{
            return FALSE;
        }

        if(file_put_contents(base_path().DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.'web.php', $routefile)){//troca o arquivo da rota com as novas adiçoes
            return TRUE;
        }else{
            return FALSE;
        }

    }

}

