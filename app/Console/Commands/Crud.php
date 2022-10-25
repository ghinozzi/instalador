<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CriarModel;

class Crud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud-generate {nome} {tabela} {campos} {data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gerar Crud';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if(CriarModel::dispatch($this->argument('nome'),$this->argument('campos'),$this->argument('data'),$this->argument('tabela'))){
            $this->line('Modelo gerado com sucesso');
        }
        /*
        if(CriarController::dispatch($this->argument('nome'))){
            $this->line('Modelo gerado com sucesso');
        }
        if(CriarViews::dispatch($this->argument('nome'))){
            $this->line('Modelo gerado com sucesso');
        }
        */

        return Command::SUCCESS;
    }
}
