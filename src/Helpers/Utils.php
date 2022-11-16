<?php

function getTypeOption($type)
{
    if (is_numeric(mb_strpos($type, 'varchar')))
        return 'varchar';
    if (is_numeric(mb_strpos($type, 'text')))
        return 'text';
    if (is_numeric(mb_strpos($type, 'timestamp')))
        return 'date';
    if (is_numeric(mb_strpos($type, 'date')))
        return 'date';
    if (is_numeric(mb_strpos($type, 'float')))
        return 'float';
    if (is_numeric(mb_strpos($type, 'double')))
        return 'float';
    if (is_numeric(mb_strpos($type, 'int')))
        return 'int';
    if (is_numeric(mb_strpos($type, 'boolean')))
        return 'boolean';
    if (is_numeric(mb_strpos($type, 'enum')))
        return 'enum';
    if (is_numeric(mb_strpos($type, 'char')))
        return 'char';
}

function getOptionFromType($type)
{
    return generateOptions(match (getTypeOption($type)) {
        'varchar' => ['Texto', 'Anexo', 'Senha'],
        'text' => ['Texto Longo', 'Editor Html'],
        'date' => ['Data', 'DateTime', 'Texto'],
        'float' => ['Dinheiro', 'Texto'],
        'int' => ['Número', 'Texto'],
        'boolean' => ['Checkbox', 'Texto'],
        'enum' => ['SelectEnum'],
        'char' => ['Senha', 'Texto'],
        default => []
    });
}

function generateOptions($options)
{
    $html = "";
    foreach ($options as $option) {
        $html .= "<option value='" . $option . "'>" . $option . "</option> \n";
    }
    return $html;
}


