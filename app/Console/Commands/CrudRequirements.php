<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Generator\InstaladorFunctions;

class CrudRequirements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:requirements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instala assets e views indispensáveis para o instalador funcionar';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Try{
            //Gerando assets
            $origem = app_path()."\Generator\assets";
            $destino = public_path()."\assets";

            $mover = InstaladorFunctions::recursive_copy($origem,$destino);
            if($mover === true){
                $this->info('Assets criados com sucesso');
            }else{
                $this->error($mover);
            }
            //Gerar arquivo de layout

            /*
            $base = app_path()."\Generator\Views\app.blade.php";
            $destino = base_path()."\resources\views\layouts\app.blade.php";
            InstaladorFunctions::gerarArquivo($base,$destino);
            */


        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }
}
