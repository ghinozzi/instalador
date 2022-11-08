<?php

namespace App\Services;

use App\Services\Utils;

class NewMenuLink
{
    protected $tabela;
    protected $plural;
    public function __construct($tabela,$plural){
        $this->tabela = $tabela;
        $this->plural = $plural;
    }
    public function criar(){
        $codigo = file_get_contents(app_path().DIRECTORY_SEPARATOR.'Generator'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'menu.php');
        $replaces = [
            'TableName'=> $this->tabela,
            'Plural'=>$this->plural
        ];
        $codigo = Utils::replaceContents($codigo,$replaces);

        $menuLinks = file_get_contents(base_path().DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'partials'.DIRECTORY_SEPARATOR.'menu-links.blade.php');

        if (mb_strpos($menuLinks, $codigo) !== FALSE) {
            return FALSE;
        }else{
            $codigo = $menuLinks . $codigo;
            if(file_put_contents(base_path().DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'partials'.DIRECTORY_SEPARATOR.'menu-links.blade.php', $codigo)){
                return TRUE;
            }else{
                return FALSE;
            }
        }


    }
}
