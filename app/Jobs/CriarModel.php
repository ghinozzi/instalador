<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CriarModel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $nomeModel;
    protected $campos;
    protected $datas;
    protected $tabela;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($nomeModel,$campos,$datas,$tabela = null)
    {
        $this->nomeModel = $nomeModel;
        $this->campos = $campos;
        $this->datas = $datas;
        if(empty($tabela)){
            $this->tabela = strtolower($nomeModel);
        }else{
            $this->tabela = $tabela;
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $codigo = file_get_contents(app_path().'\Generator\Models\Model.php');

        $campos = $this->fielsFormat($this->campos);
        $replaces = [
            'NomeModel'=> $this->nomeModel,
            'Campos'=> $campos,
            'Tabela'=> "'".$this->tabela."'",
            'Datas'=> "'".$this->datas."'"
        ];

        $codigo = $this->replaceContents($codigo,$replaces);

        if(file_put_contents(app_path().'\Models\\'.$this->nomeModel.".php", $codigo)){
            return true;
        };

    }

    protected function fielsFormat($fields){
        $array = explode(',',$fields);

        return "'".implode("','",$array)."'";
    }

    protected function replaceContents($codigo,$replaces){
        foreach ($replaces as $search => $replace)
        {
            $codigo = str_replace('__'.$search.'__' , $replace, $codigo);
        }

        return $codigo;
    }

}
