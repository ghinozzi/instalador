<?php

namespace Ghinozzi\Instalador\Services;

class NewMenuLink
{
    protected $tabela;
    protected $plural;

    public function __construct($tabela, $plural)
    {
        $this->tabela = $tabela;
        $this->plural = $plural;
    }

    public function criar()
    {
        $codigo = file_get_contents(__DIR__ . '/../Generator/Views/menu.php');

        $codigo = Utils::replaceContents($codigo, [
            'TableName' => $this->tabela,
            'Plural' => $this->plural
        ]);

        $menuLinks = file_get_contents(__DIR__ . '/../views/partials/menu-links.blade.php');

        if (mb_strpos($menuLinks, $codigo) !== FALSE) {
            return false;
        }

        $codigo = $menuLinks . $codigo;

        if (!is_dir(resource_path('views/vendor'))) {
            mkdir(resource_path('views/vendor'));
        }

        if (!is_dir(resource_path('views/vendor/instalador'))) {
            mkdir(resource_path('views/vendor/instalador'));
        }

        if (!is_dir(resource_path('views/vendor/instalador/partials'))) {
            mkdir(resource_path('views/vendor/instalador/partials'));
        }

        if (file_put_contents(resource_path('views/vendor/instalador/partials/menu-links.blade.php'), $codigo)) {
            return true;
        }

        return false;
    }
}
