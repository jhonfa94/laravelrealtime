<?php

namespace App\Console\Commands;

use App\Events\RemainingTimeChange;
use App\Events\WinnerNumberGenerated;
use Illuminate\Console\Command;

class GameExecutor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts executing the game...';

    private $time = 15;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        while (true) {
            broadcast(new RemainingTimeChange($this->time . 's'));
            $this->time--; //se disminuye
            sleep(1);

            if ($this->time === 0) {
                $this->time = 'Waiting to start';
                broadcast(new RemainingTimeChange($this->time)); // Transmitimos

                broadcast(new WinnerNumberGenerated(mt_rand(1, 12))); // Transmitimos
                sleep(5); # dormimos por 5 segundos
                $this->time = 15;
            }
        }
    }
}
