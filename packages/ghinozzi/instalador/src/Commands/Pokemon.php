<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Pokemon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instalador:pokemon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line("deu certo");
        return Command::SUCCESS;
    }
}
