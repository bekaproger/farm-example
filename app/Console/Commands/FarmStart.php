<?php

namespace App\Console\Commands;

use App\Animal;
use App\Services\FarmService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class FarmStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farm:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle( FarmService $service)
    {
        $service->initializeAnimals();

        $this->call('get:products');

        $this->call('farm:info');

    }
}
