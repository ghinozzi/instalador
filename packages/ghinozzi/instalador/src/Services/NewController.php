<?php

namespace Ghinozzi\Instalador\Services;

class NewController
{
    protected $nomeModel;
    protected $nomePasta;
    protected $nomeVariavel;
    protected $tabela;

    public function __construct($tabela, $campos)
    {
        $this->campos = $campos;
        $this->tabela = $tabela;
        $this->nomeModel = ucfirst($tabela);
        $this->nomePasta = strtolower($tabela);
        $this->nomeVariavel = strtolower($tabela);
    }

    public function criar()
    {
        $codigo = file_get_contents(__DIR__ . '/../Generator/Controller/Controller.stub');

        $relations = $this->relations();

        $codigo = Utils::replaceContents($codigo, [
            'NomeModel' => $this->nomeModel,
            'NomePasta' => $this->nomePasta,
            'NomeVariavel' => $this->nomeVariavel,
            'Relations' => $relations['relations'],
            'Compact' => $relations['compact'],
            'Uses' => $relations['uses']
        ]);

        if (file_put_contents(app_path("Http/Controllers/{$this->nomeModel}Controller.php"), $codigo)) {
            return true;
        }

        return false;
    }

    protected function relations()
    {
        $foreignKeys = InstaladorService::getForeignSchema();

        $codigo = null;
        $uses = null;
        $compact = [];
        if (!empty($foreignKeys[$this->tabela])) {
            foreach ($foreignKeys[$this->tabela] as $fk) {
                if (!empty($this->campos[$fk->fk]['referencia'])) {
                    $codigo .= "\$select_" . $fk->fk . " = " . ucfirst($fk->reftable) . "::orderBy('" . $this->campos[$fk->fk]['referencia'] . "','asc')->get(); \n";
                    $compact[] = "\"select_" . $fk->fk . "\"";
                    $uses .= "use App\\Models\\" . ucfirst($fk->reftable) . "; \n";
                }
            }
        }

        if (!empty($compact)) {
            $compact = ",compact(" . implode(',', $compact) . ")";
        } else {
            $compact = "";
        }

        return ['relations' => $codigo, 'compact' => $compact, 'uses' => $uses];
    }


}
