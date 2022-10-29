<?php

namespace App\Services;

use App\Services\Utils;

class NewRoute
{
    protected $tabela;
    public function __construct($tabela){
        $this->tabela = ucfirst($tabela);
    }
    public function criar(){
        $layoutRoute = file_get_contents(app_path().'\Generator\route\Route.php');
        $replaces = [
            'tablename'=> "".$this->tabela.""
        ];
        $layoutRoute = Utils::replaceContents($layoutRoute,$replaces);
        $Routefile = file_get_contents(base_path().'\routes\web.php');

        $referenceLineInRoute = 'use Illuminate\Support\Facades\Route;';//coloca a nova referencia após essa referencia <---
        $ControllerUse = "use App\Http\Controllers\\".$this->tabela."Controller;";

        if (mb_strpos($Routefile, $layoutRoute) == FALSE) {//verifica se as rotas ja existem
            $Routefile = $Routefile . $layoutRoute;
        }

        if (mb_strpos($Routefile, $ControllerUse) == FALSE) {//verifica o controller foi devidamente referenciada na route
            $Routefile = str_replace($referenceLineInRoute, $referenceLineInRoute."\r\n$ControllerUse", $layoutRoute);
        }else{
            return FALSE;
        }

        if(file_put_contents(base_path().'\routes\web.php', $Routefile)){//troca o arquivo da rota com as novas adiçoes
            return TRUE;
        }else{
            return FALSE;
        }

    }
    
}