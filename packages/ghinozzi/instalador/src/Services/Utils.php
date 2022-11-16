<?php

namespace Ghinozzi\Instalador\Services;

class Utils
{

    static function replaceContents($codigo, $replaces)
    {
        foreach ($replaces as $search => $replace) {
            $codigo = str_replace('__' . $search . '__', $replace, $codigo);
        }

        return $codigo;
    }

}
