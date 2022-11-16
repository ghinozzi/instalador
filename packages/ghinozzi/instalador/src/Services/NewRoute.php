<?php

namespace Ghinozzi\Instalador\Services;

class NewRoute
{
    protected $tabela;
    protected $nomeVariavel;

    public function __construct($tabela)
    {
        $this->tabela = $tabela;
        $this->nomeVariavel = strtolower($tabela);;
    }

    public function criar()
    {
        $layoutRoute = Utils::replaceContents(file_get_contents(__DIR__ . '/../Generator/Route/Route.stub'), [
            'TableName' => $this->tabela,
            'ModelName' => ucfirst($this->tabela),
            'NomeVariavel' => $this->nomeVariavel
        ]);

        $routefile = file_get_contents(base_path('routes/web.php'));
        $referenceLineInRoute = 'use Illuminate\Support\Facades\Route;';//coloca a nova referencia após essa referencia <---
        $ControllerUse = "use App\Http\Controllers\\" . ucfirst($this->tabela) . "Controller;";

        if (!mb_strpos($routefile, $layoutRoute)) {
            $routefile = $routefile . $layoutRoute;
        }

        //verifica o controller foi devidamente referenciada na route
        if (mb_strpos($routefile, $ControllerUse)) {
            return false;
        }

        $routefile = str_replace($referenceLineInRoute, $referenceLineInRoute . "\r\n$ControllerUse", $routefile);

        //troca o arquivo da rota com as novas adiçoes
        if (file_put_contents(base_path('routes/web.php'), $routefile)) {
            return true;
        }

        return false;
    }
}

