<?php

namespace Ghinozzi\Instalador\Services;

class NewView
{
    protected $fields;
    protected $table;
    protected $singular;
    protected $plural;
    protected $nomeVariavel;
    protected $primary_key;

    public function __construct($table, $fields, $singular, $plural, $primary_key)
    {
        $this->table = $table;
        $this->singular = $singular;
        $this->plural = $plural;
        $this->nomeVariavel = strtolower($table);
        $this->primary_key = $primary_key;
        $this->fields = $this->ignore_fields($fields);

        if (!is_dir(resource_path("views/{$this->table}"))) {
            mkdir(resource_path("views/{$this->table}"), 0755, true);
        }
    }

    private function ignore_fields($fields)
    {
        $ignore_fields = [$this->primary_key, 'created_at', 'updated_at', 'deleted_at'];
        foreach ($ignore_fields as $nameIgnore) {
            unset($fields[$nameIgnore]);
        }
        return $fields;
    }

    public function criarIndex()
    {
        $codigo = Utils::replaceContents(file_get_contents(__DIR__ . '/../Generator/Views/crud/index.blade.php'), [
            'TituloPlural' => $this->plural,
            'TituloSingular' => $this->singular,
            'Tabela' => $this->table,
            'TableHeaders' => $this->getTableHeaders($this->fields),
            'TableFields' => $this->getTableFields($this->fields),
            'NomeVariavel' => $this->nomeVariavel,
            'PrimaryKey' => $this->primary_key
        ]);

        if (file_put_contents(resource_path("views/{$this->table}/index.blade.php"), $codigo)) {
            return true;
        };

        return false;
    }

    public function criarCreate()
    {
        $codigo = Utils::replaceContents(file_get_contents(__DIR__ . '/../Generator/Views/crud/create.blade.php'), [
            'TituloSingular' => $this->singular,
            'Tabela' => $this->table,
            'Campos' => $this->getFieldHtml($this->fields)
        ]);

        if (file_put_contents(resource_path("views/{$this->table}/create.blade.php"), $codigo)) {
            return true;
        };

        return false;
    }

    public function criarEdit()
    {
        $codigo = Utils::replaceContents(file_get_contents(__DIR__ . '/../Generator/Views/crud/edit.blade.php'), [
            'TituloSingular' => $this->singular,
            'Tabela' => $this->table,
            'NomeVariavel' => $this->nomeVariavel,
            'CamposUpdate' => $this->getFieldHtml($this->fields, 'edit', $this->nomeVariavel),
            'PrimaryKey' => $this->primary_key
        ]);

        if (file_put_contents(resource_path("views/{$this->table}/edit.blade.php"), $codigo)) {
            return true;
        }

        return false;
    }

    protected function getTableHeaders($fields)
    {
        $headers = "";
        foreach ($fields as $name => $f):
            $field = new Field($name, $f);
            $headers .= $field->getTableHeader() . "\n";
        endforeach;

        return $headers;
    }

    protected function getTableFields($fields)
    {
        $tableFields = "";
        foreach ($fields as $name => $f):
            $field = new Field($name, $f);
            $tableFields .= $field->getTableField() . "\n";
        endforeach;
        return $tableFields;
    }

    protected function getFieldHtml($fields, $type = 'create', $nomeVariavel = null)
    {
        $fieldHtml = "";
        foreach ($fields as $name => $f):
            $field = new Field($name, $f);
            $fieldHtml .= $field->getFieldHtml($type, $nomeVariavel) . "\n";
        endforeach;
        return $fieldHtml;
    }

}
