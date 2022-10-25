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
    protected $signature = 'crud-generate {nome}';

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
        if(CriarModel::dispatch($this->argument('nome'))){
            $this->line('Modelo gerado com sucesso');
        }

        return Command::SUCCESS;
    }
}
