<?php
    function getTypeOption($type){
        if(is_numeric(mb_strpos($type,'varchar')))
            return 'varchar';
        if(is_numeric(mb_strpos($type,'text')))
            return 'text';
        if(is_numeric(mb_strpos($type,'timestamp')))
            return 'date';
        if(is_numeric(mb_strpos($type,'date')))
            return 'date';
        if(is_numeric(mb_strpos($type,'float')))
            return 'float';
        if(is_numeric(mb_strpos($type,'double')))
            return 'float';
        if(is_numeric(mb_strpos($type,'int')))
            return 'int';
        if(is_numeric(mb_strpos($type,'boolean')))
            return 'boolean';
        if(is_numeric(mb_strpos($type,'enum')))
            return 'enum';
        if(is_numeric(mb_strpos($type,'char')))
            return 'char';
    }
    function getOptionFromType($type){
        $type = getTypeOption($type);

        $options = [];
        switch($type){
            case 'varchar':
                $options = ['Texto','Anexo','Senha'];
                break;
            case 'text':
                $options = ['Texto Longo','Editor Html'];
                break;
            case 'date':
                $options = ['Data','DateTime','Texto'];
                break;
            case 'float':
                $options = ['Dinheiro','Texto'];
                break;
            case 'int':
                $options = ['Número','Texto'];
                break;
            case 'boolean':
                $options = ['Checkbox','Texto'];
                break;
            case 'enum':
                $options = ['SelectEnum'];
            case 'char':
                $options = ['Senha','Texto'];
        }

        return generateOptions($options);
    }
    function generateOptions($options){
        $html = "";
        foreach($options as $option){
            $html .= "<option value='".$option."'>".$option."</option> \n";
        }
        return $html;
    }


