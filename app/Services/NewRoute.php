<?php

namespace App\Services;

use App\Services\Utils;

class NewRoute
{
    protected $tabela;
    public function __construct($tabela){
        $this->tabela = $tabela;
    }
    public function criar(){
        $layoutRoute = file_get_contents(app_path().'\GeneratorLayout\Route.php');
        $replaces = [
            'tablename'=> "".$this->tabela.""
        ];
        $layoutRoute = Utils::replaceContents($layoutRoute,$replaces);
        $routefile = file_get_contents(base_path().'\routes\web.php');
        $referenceLineInRoute = 'use Illuminate\Support\Facades\Route;';//coloca a nova referencia após essa referencia <---
        $ControllerUse = "use App\Http\Controllers\\".$this->tabela."Controller;";

        if (!mb_strpos($routefile, $layoutRoute)) {
            $routefile = $routefile . $layoutRoute;
        }

        if (!mb_strpos($routefile, $ControllerUse)) {//verifica o controller foi devidamente referenciada na route
            $routefile = str_replace($referenceLineInRoute, $referenceLineInRoute."\r\n$ControllerUse", $routefile);
        }else{
            return FALSE;
        }

        if(file_put_contents(base_path().'\routes\web.php', $routefile)){//troca o arquivo da rota com as novas adiçoes
            return TRUE;
        }else{
            return FALSE;
        }

    }

}

