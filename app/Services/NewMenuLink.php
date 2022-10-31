<?php

namespace App\Services;

use App\Services\Utils;

class NewMenuLink
{
    protected $tabela;
    public function __construct($tabela){
        $this->tabela = ucfirst($tabela);
    }
    public function criar(){
        $codigo = file_get_contents(app_path().'\GeneratorLayout\views\menu.php');
        $replaces = [
            'tablename'=> "".$this->tabela.""
        ];
        $codigo = Utils::replaceContents($codigo,$replaces);

        $menuLinks = file_get_contents(base_path().'\resources\views\partials\menu-links.blade.php');

        if (mb_strpos($menuLinks, $codigo) !== FALSE) {
            return FALSE;
        }else{
            if(file_put_contents(base_path().'\resources\views\partials\menu-links.blade.php', $codigo)){
                $codigo = $menuLinks . $codigo;
                return TRUE;
            }else{
                return FALSE;
            }
        }

        
    }
}